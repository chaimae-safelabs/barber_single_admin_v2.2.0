<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Employee;
use App\Service;
use App\Salon;
use App\Booking;
use App\AdminSetting;
use App\EmpWorkingHours;
use App\Helpers\Helper;
use Carbon\Carbon;
use DB;

class EmployeeController extends Controller
{

    public function index()
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        if(isset($salon->salon_id))
        {
            $emps = Employee::where([['salon_id',$salon->salon_id],['isdelete',0]])
            ->orderBy('emp_id', 'DESC')
            ->paginate(10);
        }
        else
        {
            $emps = Employee::paginate(10);
        }

        return view('admin.pages.employee', compact('emps'));
    }

    public function create()
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        if(isset($salon->salon_id))
        {
            $services = Service::where([['salon_id', $salon->salon_id],['isdelete',0]])->orderBy('cat_id', 'ASC')->get();
        }
        else
        {
            $services = Service::get();
        }

        return view('admin/employee/create', compact('services', 'salon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:employee',
            'services' => 'bail|required',
            'phone' => 'bail|required|numeric|unique:employee',
            'image' => 'mimes:jpeg,png,jpg',
        ]);
        $emp = new Employee();
        if($request->hasFile('image'))
        {
            $emp->image = (new Helper)->imageUpload($request->image,'employee');
        }
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $emp->salon_id = $salon->salon_id;
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->service_id = json_encode($request->services);
        $emp->save();

        $start_time = Carbon::parse($salon->start_time)->format('h:i A');
        $end_time = Carbon::parse($salon->end_time)->format('h:i A');
        $day_index=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        for($i=0; $i<count($day_index);$i++)
        {
            $workinghours= new EmpWorkingHours();
            $master = array();
            $temp['start_time']=$start_time;
            $temp['end_time']=$end_time;
            array_push($master,$temp);
            $workinghours->period_list=json_encode($master);
            $workinghours->day_index = $day_index[$i];
            $workinghours->emp_id = $emp->emp_id;
            $workinghours->salon_id = $salon->salon_id;
            $workinghours->status = 1;
            $workinghours->save();
        }
        return redirect('/admin/employee');
    }

    public function show($id)
    {
        $emp = Employee::find($id);
        $appointment = Booking::where('emp_id',$id)->get();
        $arr = array();
        foreach($appointment as $item)
        {
            array_push($arr,$item->user_id);
        }
        $count = array_count_values($arr);
        $client = array_keys($count);
        $symbol = AdminSetting::find(1)->currency_symbol;
        $workinghours = EmpWorkingHours::where('emp_id',$emp->emp_id)->get();
        return view('admin.employee.show', compact('emp','appointment','client','symbol','workinghours'));
    }

    public function edit($id)
    {
        $emp = Employee::find($id);
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $services = Service::where([['salon_id', $salon->salon_id],['isdelete',0]])->orderBy('cat_id', 'ASC')->get();

        $appointment = Booking::where('emp_id',$id)->get();
        $arr = array();
        foreach($appointment as $item)
        {
            array_push($arr,$item->user_id);
        }
        $count = array_count_values($arr);
        $client = array_keys($count);
        $symbol = AdminSetting::find(1)->currency_symbol;
        $workinghours = EmpWorkingHours::where('emp_id',$emp->emp_id)->get();
        return view('admin.employee.edit', compact('emp', 'services', 'salon','appointment','client','symbol','workinghours'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:employee,email,' . $id . ',emp_id',
            'services' => 'bail|required',
            'phone' => 'bail|required|numeric|unique:employee,phone,' . $id . ',emp_id',
            'image' => 'mimes:jpg,png,jpeg',
        ]);

        $emp = Employee::find($id);
        if($request->hasFile('image'))
        {
            if($emp->image != "noimage.jpg")
            {
                if(\File::exists(public_path('/storage/images/employee/'. $emp->image))){
                    \File::delete(public_path('/storage/images/employee/'. $emp->image));
                }
            }
            $emp->image = (new Helper)->imageUpload($request->image,'employee');

        }

        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->service_id = json_encode($request->services);
        $emp->save();

        $workingHours = EmpWorkingHours::where('emp_id', $emp->emp_id)->get();
        $data = $request->all();
        foreach ($workingHours as $workingHour) {
            $master = array();
            $start_time = $data['start_time_' . $workingHour->day_index];
            $end_time = $data['end_time_' . $workingHour->day_index];
            for ($i = 0; $i < count($start_time); $i++) {
                $temp['start_time'] = $start_time[$i];
                $temp['end_time'] = $end_time[$i];
                array_push($master, $temp);
            }
            $workingHour->status = isset($data['status' . $workingHour->day_index]) ? 1 : 0;
            $workingHour->period_list = json_encode($master);
            $workingHour->save();
        }
        return redirect('/admin/employee');
    }

    public function destroy($id)
    {
         // Delete Booking
        $booking = Booking::where('emp_id',$id)->get();
         foreach($booking as $item){
             $item->delete();
        }
        $emp = Employee::find($id);
        $emp->isdelete = 1;
        $emp->status = 0;
        $emp->save();
        return redirect('/admin/employee');
    }
    public function hideEmp(Request $request)
    {
        $emp = Employee::find($request->empId);
        if ($emp->status == 0)
        {
            $emp->status = 1;
            $emp->save();
        }
        else if($emp->status == 1)
        {
            $emp->status = 0;
            $emp->save();
        }
    }
}

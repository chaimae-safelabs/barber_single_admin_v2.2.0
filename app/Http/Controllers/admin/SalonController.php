<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Salon;
use App\Category;
use App\Service;
use App\Employee;
use App\Review;
use App\Booking;
use App\AdminSetting;
use App\Helpers\Helper;
use App\User;
use App\WorkingHours;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SalonController extends Controller
{
    public function index()
    {
        $salon = Salon::where([['owner_id', '=', Auth::user()->id]])->first();
        if(isset($salon->salon_id))
        {
            $services = Service::where([['status',1],['salon_id',$salon->salon_id]])->get();
            $emps = Employee::where([['status',1],['salon_id',$salon->salon_id]])->get();
            $reviews = Review::where('salon_id',$salon->salon_id)->get();
            $bookings = Booking::where([['salon_id',$salon->salon_id],['payment_status',1]])->get();
        }
        else
        {
            $services = Service::get();
            $emps = Employee::get();
            $reviews = Review::get();
            $bookings = Booking::get();

        }
        $ar = array();
        foreach ($bookings as $user)
        {
            array_push($ar,$user->user_id);
        }
        $users = User::whereIn('id',$ar)->get();
        $workinghours = WorkingHours::where('salon_id',$salon->salon_id)->get();
        return view('admin.salon.show', compact('salon','services','emps','reviews','users','workinghours'));
    }

    public function create()
    {
        return view('admin.salon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'desc' => 'bail|required',
            'gender' => 'bail|required',
            'phone' => 'bail|required|numeric|unique:salon',
            'address' => 'bail|required',
            'city' => 'bail|required',
            'state' => 'bail|required',
            'country' => 'bail|required',
            'zipcode' => 'bail|required|numeric',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required'
        ]);

        $salon = new Salon();
        if ($request->hasFile('image')) {
            $image = (new Helper)->imageUpload($request->image,'salon logos');           
            $salon->image = $image;           
        }
        else{
            $salon->image ='default.jpg';
        }

        if ($request->hasFile('logo')) {
            $image = (new Helper)->imageUpload($request->logo,'salon logos');           
            $salon->logo = $image;           
        }
        else{
            $salon->logo = 'logo.png';
        }

        $salon->name = $request->name;
        $salon->desc = $request->desc;
        $salon->gender = $request->gender;
        $salon->address = $request->address;
        $salon->zipcode = $request->zipcode;
        $salon->city = ucfirst($request->city);
        $salon->state = ucfirst($request->state);
        $salon->country = ucfirst($request->country);
        $salon->website = $request->website;
        $salon->phone = $request->phone;
        $salon->owner_id = auth()->user()->id;
        $salon->longitude = $request->long;
        $salon->latitude = $request->lat;
        $salon->start_time = Carbon::parse($request->start_time)->format('h:i A');
        $salon->end_time = Carbon::parse($request->end_time)->format('h:i A');
        $salon->save();
        $start_time = Carbon::parse($salon->start_time)->format('h:i A');
        $end_time = Carbon::parse($salon->end_time)->format('h:i A');
        $day_index=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        for($i=0; $i<count($day_index);$i++)
        {
            $workinghours= new WorkingHours;
            $master = array();
            $temp['start_time']=$start_time;
            $temp['end_time']=$end_time;
            array_push($master,$temp);
            $workinghours->period_list=json_encode($master);
            $workinghours->day_index = $day_index[$i];
            $workinghours->salon_id = $salon->salon_id;
            $workinghours->status = 1;
            $workinghours->save();
        }
        return redirect('/admin/dashboard');
    }

    public function edit()
    {
        $salon = Salon::where('owner_id',Auth()->user()->id)->first();
        $workinghours = WorkingHours::where('salon_id',$salon->salon_id)->get();

        return view('admin.salon.edit', compact('salon','workinghours'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'desc' => 'bail|required',
            'gender' => 'bail|required',
            'website' => '',
            'phone' => 'bail|required|numeric|unique:salon,phone,' . $id . ',salon_id',
            'address' => 'bail|required',
            'city' => 'bail|required',
            'state' => 'bail|required',
            'country' => 'bail|required',
            'zipcode' => 'bail|required|numeric'
        ]);

        $salon = Salon::find($id);
        if($request->hasFile('image'))
        {
            if(\File::exists(public_path('/storage/images/salon logos/'. $salon->image))){
                \File::delete(public_path('/storage/images/salon logos/'. $salon->image));
            }

            $image = (new Helper)->imageUpload($request->image,'salon logos');
            $salon->image = $image;
               

        }
        if($request->hasFile('logo'))
        {
            if(\File::exists(public_path('/storage/images/salon logos/'. $salon->logo))){
                \File::delete(public_path('/storage/images/salon logos/'. $salon->logo));
            }

            $image = (new Helper)->imageUpload($request->logo,'salon logos');               
            $salon->logo = $image;                
        }

        $salon->name = $request->name;
        $salon->desc = $request->desc;

        $salon->address = $request->address;
        $salon->zipcode = $request->zipcode;
        $salon->city = ucfirst($request->city);
        $salon->state = ucfirst($request->state);
        $salon->country = ucfirst($request->country);
        $salon->website = $request->website;
        $salon->phone = $request->phone;
        $salon->gender = $request->gender;
        $salon->longitude = $request->long;
        $salon->latitude = $request->lat;
        $salon->save();

        $workingHours = WorkingHours::where('salon_id', $id)->get();
        $data = $request->all();
        foreach ($workingHours as $workingHour) {
            $master = array();
            $start_time = $data['start_time_' . $workingHour->day_index];
            $end_time = $data['end_time_' . $workingHour->day_index];
            for ($i = 0; $i < count($start_time); $i++)
            {

                $temp['start_time'] = $start_time[$i];
                $temp['end_time'] = $end_time[$i];
                array_push($master, $temp);

            }
            $workingHour->status = isset($data['status' . $workingHour->day_index]) ? 1 : 0;
            $workingHour->period_list = json_encode($master);
            $workingHour->save();
        }
        return redirect('/admin/salon');
    }

    public function hideSalon(Request $request)
    {
        $salon = Salon::find($request->salonId);
        if ($salon->status == 0)
        {
            $salon->status = 1;
            $salon->save();
        }
        else if($salon->status == 1)
        {
            $salon->status = 0;
            $salon->save();
        }
    }

    public function salonDayOff(Request $request)
    {
        $salon = Salon::where([['owner_id', '=', Auth::user()->id]])->first();
        $salon_day = $request->day;
        $salon->$salon_day = json_encode(array('open' => null,'close' => null));
        $salon->save();
    }
}

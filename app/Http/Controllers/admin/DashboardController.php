<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Salon;
use App\Category;
use App\Booking;
use App\Service;
use App\AdminSetting;
use App\Template;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTP;
use Carbon\Carbon;
use Redirect;
use Math;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', '=', 3)
        ->orderBy('id','DESC')->get();
        $salon = Salon::first();
        if(isset($salon->salon_id))
        {
            $services = Service::where([['salon_id', $salon->salon_id],['isdelete',0]])->get();
        }
        else
        {
            $services = Service::get();
        }

        $categories = Category::where('status',1)->count();
        $payment = Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])->sum('payment');

        $table_cat = Category::orderBy('cat_id','DESC')->get();
        $setting = AdminSetting::find(1,['currency_symbol']);

        // top service
        $ar = array();
        $master = array();
        $top_services = array();
        if(isset($salon->salon_id))
        {
            $book_service = Booking::where('salon_id',$salon->salon_id)->get();
            foreach($book_service as $item)
            {
                $ab = json_decode($item->service_id);
                foreach($ab as $value)
                {
                    array_push($ar,$value);
                }
            }
        }
        $reduce = array_count_values($ar);
        arsort($reduce);
        foreach ($reduce as $k => $v)
        {
            array_push($master,$k);
        }
        $count = 0;
        foreach ($master as $key)
        {
            $count++;
            if($count == 6)
            {
                break;
            }
            array_push($top_services,Service::find($key));
        }

        // Upcoming
       
        $upcommings = Booking::where([['salon_id',$salon->salon_id],['date', '>=', Carbon::today()->toDateString()],['booking_status','Approved']])
        ->orderBy('date', 'asc')
        ->orderBy('start_time', 'asc')
        ->take(8)
        ->get();
        $symbol = AdminSetting::find(1)->currency_symbol;
        return view('admin.pages.dashboard', compact('users','symbol','services','upcommings','top_services','categories','payment','table_cat','setting'));
    }

    // User Charts
    public function adminUserChartData()
    {
        $masterYear = array();
        $labelsYear = array();

        array_push($masterYear,User::where([['status',1],['role',3]])
        ->whereMonth('created_at', Carbon::now())
        ->count());

        for ($i=1; $i <= 11 ; $i++)
        {
            if($i >= Carbon::now()->month){
                array_push($masterYear,User::where([['status',1],['role',3]])
                ->whereMonth('created_at',Carbon::now()->subMonths($i))
                ->whereYear('created_at', Carbon::now()->subYears(1))
                ->count());
            } else {
                array_push($masterYear,User::where([['status',1],['role',3]])
                ->whereMonth('created_at',Carbon::now()->subMonths($i))
                ->whereYear('created_at', Carbon::now()->year)
                ->count());
            }
            
        }

        array_push($labelsYear, Carbon::now()->format('M-y'));
        for ($i=1; $i <= 11 ; $i++)
        { 
            array_push($labelsYear, Carbon::now()->subMonths($i)->format('M-y'));
        }

        return [$masterYear,$labelsYear];
    }

    public function adminUserMonthChartData()
    {
        $masterMonth = array();
        $labelsMonth = array();

        array_push($masterMonth,User::where([['status',1],['role',3]])
        ->whereDate('created_at',Carbon::today()->format('Y-m-d'))
        ->count());
        for ($i=1; $i <= 30 ; $i++)
        { 

            array_push($masterMonth,User::where([['status',1],['role',3]])
            ->whereDate('created_at',Carbon::now()->subDays($i)->format('Y-m-d'))
            ->count());
        }

        array_push($labelsMonth,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 30 ; $i++)
        { 
            array_push($labelsMonth,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$masterMonth,$labelsMonth];
    }
    
    public function adminUserWeekChartData()
    {
        $masterWeek = array();
        $labelsWeek = array();

        array_push($masterWeek,User::where([['status',1],['role',3]])
        ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
        ->count());
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($masterWeek,User::where([['status',1],['role',3]])
            ->whereDate('created_at', Carbon::now()->subDays($i)->format('Y-m-d'))
            ->count());
        }

        array_push($labelsWeek,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($labelsWeek,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$masterWeek,$labelsWeek];
    }

    // Revenue Chart
    public function adminRevenueChartData()
    {
        $masterYear = array();
        $labelsYear = array();

        array_push($masterYear,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
        ->whereMonth('date', Carbon::now())
        ->sum('payment')));
        
        for ($i=1; $i <= 11 ; $i++)
        {
            if($i >= Carbon::now()->month) {
                array_push($masterYear,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
                ->whereMonth('date',Carbon::now()->subMonths($i))
                ->whereYear('date', Carbon::now()->subYears(1))
                ->sum('payment')));
            } else {
                array_push($masterYear,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
                ->whereMonth('date',Carbon::now()->subMonths($i))
                ->whereYear('date', Carbon::now()->year)
                ->sum('payment')));
            }
            
        }

        array_push($labelsYear, Carbon::now()->format('M-y'));
        for ($i=1; $i <= 11 ; $i++)
        { 
            array_push($labelsYear, Carbon::now()->subMonths($i)->format('M-y'));
        }

        return [$masterYear,$labelsYear];
    }

    public function adminRevenueMonthChartData()
    {
        $masterMonth = array();
        $labelsMonth = array();

        array_push($masterMonth,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
        ->whereDate('date', Carbon::today()->format('Y-m-d'))
        ->sum('payment')));
        for ($i=1; $i <= 30 ; $i++)
        { 
            array_push($masterMonth,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
            ->whereDate('date',Carbon::now()->subDays($i)->format('Y-m-d'))
            ->sum('payment')));
        }

        array_push($labelsMonth,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 30 ; $i++)
        { 
            array_push($labelsMonth,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$masterMonth,$labelsMonth];
    }
    
    public function adminRevenueWeekChartData()
    {
        $masterWeek = array();
        $labelsWeek = array();

        array_push($masterWeek,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
        ->whereDate('date', Carbon::today()->format('Y-m-d'))
        ->sum('payment')));
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($masterWeek,ceil(Booking::where([['payment_status',1],['booking_status','!=','Cancelled']])
            ->whereDate('date',Carbon::now()->subDays($i)->format('Y-m-d'))
            ->sum('payment')));
        }

        array_push($labelsWeek,Carbon::now()->format('d-M'));
        for ($i=1; $i <= 6 ; $i++)
        { 
            array_push($labelsWeek,Carbon::now()->subDays($i)->format('d-M'));
        }

        return [$masterWeek,$labelsWeek];
    }

}

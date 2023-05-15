<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Salon;
use App\AdminSetting;
use Redirect;

class ReportController extends Controller
{
    
    public function user(Request $request)
    {
        if(isset($request->filter_date)){
            if($request->filter_date != null)
            {
                $pass = $request->filter_date;
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                $to = $dates[1];

                $users = User::where('role',3)
                ->orderBy('created_at','ASC')
                ->get();
                foreach ($users as $user) {
                    $user->appointment = Booking::where([['user_id',$user->id],['booking_status','!=','Cancelled']])
                    ->whereBetween('date', [$from, $to])
                    ->count();
                }
                
                $users = $users->sortByDesc('appointment')->values()->all();
                return view('admin.report.userReport',compact('users','pass'));
            }
            else{
                return redirect('/admin/report/user')->withErrors(['Select Date In Range']);
            }
        } else {
            $pass = '';
            $users = User::where('role',3)
            ->orderBy('id','DESC')
            ->get();
            foreach ($users as $user) {
                $user->appointment = Booking::where([['user_id',$user->id],['booking_status','!=','Cancelled']])->count();
            }
            $users = $users->sortByDesc('appointment')->values()->all();
            return view('admin.report.userReport',compact('users','pass'));
        }
    }

    public function revenue(Request $request)
    {
        if(isset($request->filter_date)){
            if($request->filter_date != null)
            {
                $pass = $request->filter_date;
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                $to = $dates[1];
                $bookings = Booking::where('payment_status',1)
                ->whereBetween('date', [$from, $to])
                ->orderBy('date', 'ASC')
                ->get();
                $setting = AdminSetting::find(1,['currency_symbol']);
                return view('admin.report.revenueReport',compact('bookings','setting','pass'));
            }
            else{
                return redirect('/admin/report/revenue')->withErrors(['Select Date In Range']);
            }
        } else {
            $pass = '';
            $bookings = Booking::where('payment_status',1)
            ->orderBy('id', 'DESC')
            ->get();
            $setting = AdminSetting::find(1,['currency_symbol']);
            return view('admin.report.revenueReport',compact('bookings','setting','pass'));
        }
    }
}
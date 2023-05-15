<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Salon;
use App\Service;
use App\User;
use Carbon\Carbon;

class CalendarController extends Controller
{


    public function index()
    {
        $salon_id = Salon::where('owner_id', Auth()->user()->id)->first()->salon_id;
        $appointments = Booking::with('user')->where('salon_id', $salon_id)->get();
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $users = User::where([['status', 1], ['role', 3]])->get();
        $services = Service::where([['salon_id', $salon->salon_id], ['isdelete', 0]])->get();
        foreach($appointments as $appointment)
        {
            $time = Carbon::parse($appointment['start_time'])->format('H:i:s');
            $appointment['start'] = $appointment['date'].' '.$time;
            if ($appointment->booking_status == "Cancelled")
            {
                $appointment['bgColor'] = "rgba(251, 175, 190, .5)";
                $appointment['textColor'] = "#b3092b";
            }
            else if($appointment->booking_status == "Pending")
            {
                $appointment['bgColor'] = "rgba(203, 210, 246, .5)";
                $appointment['textColor'] = "#2236a8";
            }
            else if($appointment->booking_status == "Approved")
            {
                $appointment['bgColor'] = "rgba(136, 230, 247, .5)";
                $appointment['textColor'] = "#05879e";
            }
            else if($appointment->booking_status == "Completed")
            {
                $appointment['bgColor'] = "rgba(147, 231, 195, .5)";
                $appointment['textColor'] = "#1a8a59";
            }
            else{
                $appointment['bgColor'] = "rgba(11, 11, 11, .5)";
                $appointment['textColor'] = "#111111";
            }

        }
        return view('admin.pages.calendar', compact('appointments', 'users', 'services'));
    }
   
}

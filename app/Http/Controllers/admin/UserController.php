<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Booking;
use App\AdminSetting;
use App\Address;
use App\Notification;
use App\Salon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->filter_date)){
            if($request->filter_date != null)
            {
                $pass = $request->filter_date;
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                $to = $dates[1];

                $users = User::where('role', '=', 3)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('id','DESC')->get();
                return view('admin.pages.user', compact('users','pass')); 
            } else {
                return redirect('/admin/users')->withErrors(['Select Date In Range']);
            }
        } else {
            $pass = '';
            $users = User::where('role', '=', 3)
            ->orderBy('id','DESC')->get();
            return view('admin.pages.user', compact('users','pass'));
        }
    }
    
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'numeric'],
            'code' => ['required','numeric'],
        ]);

        $salon = Salon::where('owner_id',Auth::user()->id)->first();
        $salon_id = $salon->salon_id;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->code = "+".$request->code;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->added_by = $salon_id;
        $user->verify = 1;
        $user->save();
        return response()->json(['success' => true,'data' => $user, 'msg' => 'Client create'], 200);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $completed = Booking::where([['user_id',$user->id],['booking_status','Completed']])->orderBy('date','DESC')->get();
        $pending = Booking::where([['user_id',$user->id],['booking_status','Pending']])->orderBy('date','DESC')->get();
        $approved = Booking::where([['user_id',$user->id],['booking_status','Approved']])->orderBy('date','DESC')->get();
        $cancel = Booking::where([['user_id',$user->id],['booking_status','Cancelled']])->orderBy('date','DESC')->get();
        $setting = AdminSetting::find(1,['currency_symbol']);
        $address = Address::where('user_id',$user->id)->get();
        return view('admin.users.show', compact('user','completed','cancel','pending','approved','setting','address'));
    }

    public function destroy($id)
    {
        // delete address
        $addr = Address::where('user_id',$id)->get();
        foreach($addr as $item){
            $item->delete();
        }

        // Delete Booking
        $booking = Booking::where('user_id',$id)->get();
        foreach($booking as $item){
            $item->delete();
        }

        // Delete Notification
        $notification = Notification::where('user_id',$id)->get();
        foreach($notification as $item){
            $item->delete();
        }

        // delete Review
        $review = Review::where('user_id',$id)->get();
        foreach($review as $item){
            $item->delete();
        }

        // delete User
        $user = User::find($id);
        if($user->image != "noimage.jpg") {
            \File::delete(public_path('/storage/images/users/'. $user->image));
        }
        $user->delete();
        return redirect()->back();
    }

    public function hideUser(Request $request)
    {
        $user = User::find($request->userId);
        if ($user->status == 0) 
        {   
            $user->status = 1;
            $user->save();
        }
        else if($user->status == 1)
        {
            $user->status = 0;
            $user->save();
        }
    }
}
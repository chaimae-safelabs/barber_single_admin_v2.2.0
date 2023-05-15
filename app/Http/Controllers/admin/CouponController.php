<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\User;
use App\Salon;
use App\AdminSetting;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('coupon_id', 'DESC')->paginate(8);
        $symbol = AdminSetting::find(1)->currency_symbol;     
        return view('admin.pages.coupon', compact('coupons','symbol'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'bail|required',
            'type' => 'bail|required',
            'discount' => 'bail|required|numeric',
            'max_use' => 'bail|required|numeric',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->desc = $request->desc;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->max_use = $request->max_use;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;

        $coupon->save();
        return redirect('admin/coupon');
    }

    public function show($id)
    {
        $data['coupon'] = Coupon::find($id);
        $data['symbol'] = AdminSetting::find(1)->currency_symbol;     
        return response()->json(['success' => true,'data' => $data, 'msg' => 'Coupon show'], 200);
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return response()->json(['success' => true,'data' => $coupon], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => 'bail|required',
            'type' => 'bail|required',
            'discount' => 'bail|required|numeric',
            'max_use' => 'bail|required|numeric',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ]);
        $coupon = Coupon::find($id);

        $coupon->desc = $request->desc;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->max_use = $request->max_use;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();
        return response()->json(['success' => true,'data' => $coupon, 'msg' => 'Coupon edit'], 200);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect('admin/coupon');
    }
    public function hideCoupon(Request $request)
    {
        $coupon = Coupon::find($request->couponId);
        if ($coupon->status == 0) 
        {   
            $coupon->status = 1;
            $coupon->save();
        }
        
        else if($coupon->status == 1)
        {
            $coupon->status = 0;
            $coupon->save();
        }
    }
}

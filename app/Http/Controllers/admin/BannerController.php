<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Banner;
use App\Helpers\Helper;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->paginate(5);
        return view('admin.pages.banner', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required',
            'image' => 'bail|required|mimes:jpeg,png,jpg'
        ]);

        $banner = new Banner();
        if($request->hasFile('image'))
        {
            $banner->image = (new Helper)->imageUpload($request->image,'banner');
        }
        $banner->title = $request->title;
        $banner->save();
        return response()->json(['success' => true,'data' => $banner, 'msg' => 'Banner create'], 200);
    }

    public function show($id)
    {
        $data['banner'] = Banner::find($id);
        return response()->json(['success' => true,'data' => $data, 'msg' => 'Banner show'], 200);
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return response()->json(['success' => true,'data' => $banner], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required',
        ]);
        $banner = Banner::find($id);
        if($request->hasFile('image'))
        {
            if(\File::exists(public_path('/storage/images/banner/'. $banner->image))){
                \File::delete(public_path('/storage/images/banner/'. $banner->image));
            }            
            $banner['image'] = (new Helper)->imageUpload($request->image,'banner');
            
        }
        $banner->title = $request->title;
        $banner->save();        
        return response()->json(['success' => true,'data' => $banner, 'msg' => 'Banner edit'], 200);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        \File::delete(public_path('/storage/images/banner/'. $banner->image));
        $banner->delete();
        return response()->json(['success' => true,'data' => $banner, 'msg' => 'Banner Deleted'], 200);
    }
    public function hideBanner(Request $request)
    {
        $banner = Banner::find($request->bannerId);
        if ($banner->status == 0) 
        {   
            $banner->status = 1;
            $banner->save();
        }
        else if($banner->status == 1)
        {
            $banner->status = 0;
            $banner->save();
        }
    }
}
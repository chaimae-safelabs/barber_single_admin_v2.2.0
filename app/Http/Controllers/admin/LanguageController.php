<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;
use App;
use App\Helpers\Helper;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('id', 'DESC')->paginate(10);
        return view('admin.pages.language', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:language',
            'language_file' => 'bail|required|mimes:json',
            'image' => 'bail|required|mimes:jpeg,png,jpg',
            'direction' => 'bail|required',
        ]);

        $language = new Language();
        if($request->hasFile('language_file'))
        {
            $json = $request->file('language_file');
            $name = $request->name.'.'. $json->getClientOriginalExtension();
            $destinationPath = resource_path('/lang');
            $json->move($destinationPath, $name);
            $language->file = $name;
        }
        if($request->hasFile('image'))
        {
            $language->image = (new Helper)->imageUpload($request->image,'language');
        }
        $language->name = $request->name;
        $language->direction = $request->direction;
        $language->save();
        return response()->json(['success' => true,'data' => $language, 'msg' => 'Language create'], 200);
    }
    
    public function hideLanguage(Request $request)
    {
        $language = Language::find($request->languageId);
        if ($language->status == 0)
        {   
            $language->status = 1;
            $language->save();
        }
        else if($language->status == 1)
        {
            $language->status = 0;
            $language->save();
        }
        return response()->json(['success' => true, 'msg' => 'Status Changed'], 200);
    }
    public function changeDirection(Request $request)
    {
        $language = Language::find($request->languageId);
        if ($language->direction == "rtl")
        {   
            $language->direction = "ltr";
            $language->save();
        }
        else if($language->direction == "ltr")
        {
            $language->direction = "rtl";
            $language->save();
        }
        return response()->json(['success' => true, 'msg' => 'Direction Changed'], 200);
    }

    public function language($lang)
    {
        $icon = \App\Language::where('name',$lang)->first();
        App::setLocale($lang);
        session()->put('locale', $lang);
        if($icon){
            session()->put('direction', $icon->direction);
        }
        return redirect()->back();
    }
    
    public function downloadSample() {
        $pathToFile = public_path(). "/file/English.json";
        $name = 'TheBarber_Language_Sample.json';
        $headers = array('Content-Type: application/pdf',);
        return response()->download($pathToFile, $name, $headers);
    }
}
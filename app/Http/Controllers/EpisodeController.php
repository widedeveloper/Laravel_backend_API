<?php

namespace App\Http\Controllers;


use App\Country;
use App\Podcast;
use App\Episode;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Image;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes  = DB::table('episodes')
            ->join('podcasts', 'episodes.podcast_id', '=', 'podcasts.id')
            ->select('episodes.*', 'podcasts.title as podcast_name')
            ->orderBy("id")
            ->paginate(10);

        return view('episodes.index',compact('episodes'));
    }

    public function create()
    {
        $podcasts = Podcast::all();
        return view('episodes.episodeAdd',compact('podcasts'));
    }

    public function store(Request $request)
    {
        $image_upload = false;
        $image = $request->file('image');
        
        if($image){
            $maxId = Episode::select('id')->orderBy('id', 'desc')->first();
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

        $episode = new Episode();
        $episode->title   = Input::get('title');
        $episode->url   = Input::get('url');   
        $episode->podcast_id   = Input::get('podcast_id');   
        if(isset($image_url)) $episode->image = $image_url;  

        $episode->save();

        return redirect('episodes');
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
        $episode = Episode::find($id);
        $podcasts = Podcast::all();
        return view('episodes.episodeEdit',compact('episode','podcasts'));
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

        $episode = Episode::find($id);
        $episode->title   = Input::get('title');
        $episode->url   = Input::get('url');   
        $episode->podcast_id   = Input::get('podcast_id');   
        if(isset($image_url)) $episode->image = $image_url;  

        $episode->save();

        return redirect('episodes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id);
        $episode->delete();
        return redirect('episodes');
    }
}

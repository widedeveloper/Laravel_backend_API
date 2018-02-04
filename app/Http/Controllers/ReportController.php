<?php

namespace App\Http\Controllers;


use App\Radio;
use App\Region;
use App\Country;
use App\Stream;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;


class ReportController extends Controller
{
    public function index(Request $request) {
        $s = $request->s;  
        $reports = DB::table('reports')->select('ping_date', 'country_name', 
                                'stream_url','radio_name','radio_id','stream_id',DB::raw('count(id) as total'))
                            ->orderBy('ping_date','desc')->groupBy('ping_date','country_name','stream_url','radio_name','radio_id','stream_id');
        if(isset($s))$reports -> where('country_name','like','%'.$s.'%');
        $reports = $reports ->paginate(10);
        return view('reports.index',compact('reports','s'));
    }
}

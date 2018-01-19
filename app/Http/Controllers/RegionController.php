<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use App\Subquery;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Query\Expression;
class RegionController extends Controller
{
    
    public function index()
    {
        $regions = DB::table('regions')
            ->join('countries', 'regions.country_id', '=', 'countries.id')
            ->select('regions.*', 'countries.name as country_name')
            ->orderBy("name")
            ->paginate(10);
        return view('regions.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('regions.regionAdd',compact('countries'));
    }

  
    public function store(Request $request)
    {
        $region= new Region();
        $region->name= $request['name'];
        $region->country_id= $request['country'];
        $region->save();
        return redirect('regions');
    }

    
    public function show($id)
    {
        $region = Region::find($id);

        $radios = DB::table('radios')
                ->join('regions', 'radios.region_id', '=', 'regions.id')
                ->join('countries', 'radios.country_id', '=', 'countries.id')
                ->select('radios.*', 'countries.name as country_name', 'regions.name as region_name')
                ->where("region_id",$id)
                ->orderBy('name')
                ->paginate(10);

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
       
        return view('regions.regionshow',compact('region','radios','result'));
    }

    
    public function edit($id)
    {
        $region = Region::find($id);
        $countries = Country::all();
        return view('regions.regionEdit',compact('region','countries'));
    }

   
    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);
        $region->name   = Input::get('name');
        $region->country_id  = Input::get('country');
       
        $region->save();
        return redirect('regions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();
        return redirect('regions');
    }
}

<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    
    public function index()
    {
        $countries = Country::orderBy('name')->paginate(10);
        return view('countries.index',compact('countries'));
    }

   
    public function create()
    {
        return view('countries.countryAdd');
    }

    
    public function store(Request $request)
    {
        $county= new Country();
        $county->name= $request['name'];
        $county->code= $request['code'];
        $county->save();
        return redirect('countries');
    }

    
    public function show($id)
    {
        $country = Country::find($id);
        $regions = DB::table('regions')->where("country_id",$id)->orderBy('name')->paginate(10);
        // $radios = DB::table('radios')->where("country_id",$id)->orderBy('name')->paginate(10);
        
        return view('countries.countryshow',compact('country','regions'));
    }
    
    public function edit($id)
    {
        $country = Country::find($id);
        return view('countries.countryEdit',compact('country'));
    }
   
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->name   = Input::get('name');
        $country->code   = Input::get('code');       
        $country->save();
        return redirect('countries');
    }
   
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('countries');
    }
}

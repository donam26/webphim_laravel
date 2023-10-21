<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Country\CountryService;

class CountryController extends Controller
{
    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }
    public function index()
    {

    }

    public function create()
    {
        $title = 'Quốc Gia';
        $lists = $this->countryService->getCountry();
        return view('admincp.country.form',compact('title','lists'));
    }

    public function store(Request $request)
    {
        $this->countryService->store($request);
        return redirect()->back();
    }

    public function show($id)
    {
    }
    
    public function edit($id)
    {
        $country = $this->countryService->getId($id);
        $lists = $this->countryService->getCountry();
        return view('admincp.country.form',compact('lists','country'));
    }

    public function update(Request $request, $id)
    {
        $this->countryService->update($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->countryService->delete($id);
        return redirect()->back();
    }

    
}

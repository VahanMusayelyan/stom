<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use App\Employee;
use Illuminate\Support\Facades\DB;

class SpecializationController extends AppController
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('specializ_types')->get()->toArray();
      
        return view('specializations.list', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specializations.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'specialization' => ['required', 'max:50'],
        ]);
        
        $specialization = $request->specialization;
        DB::table('specializ_types')->insert([
            'specialization' => $specialization
        ]);
        
         return redirect()->route('specializations.create')->with('success','Специализация успешно добавлено');;
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
        $result = DB::table('specializ_types')->select()->where('id',$id)->get()->toArray();

        return view('specializations.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
            'specialization_edit' => ['required', 'max:50'],
        ]);
        
        $specialization = $request->specialization_edit;
        DB::table('specializ_types')->where('id',$id)->update([
            'specialization' => $specialization
        ]);
        
  
         return redirect('/specializations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('specializ_types')->where('id',$id)->delete();
        return redirect('/specializations');
    }
}

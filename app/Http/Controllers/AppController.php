<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Redirect;
use Validator;
use Session;
class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('layouts/landing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    
    /**Store sign up email from landing page**/
    public function storeEmail(Request $request){
        $email = $request->input('email');
        $validator = Validator::make($request->all(),['email'=>'required'],['required'=>'Este campo é requerido']);
        
        if($validator->fails()){
                $error = $validator->messages();
                return Redirect::route('index')->withErrors($validator)->withInput($request->all());
        }else{
            DB::beginTransaction();
            try{
                DB::table('subscribers')
                    ->insert(['email'=>$email,'created_at'=>new DateTime]); 
                DB::commit();
                return Redirect::route('index')->with('success','Email inscrito com sucesso!');
            }catch(\Exception $ex){
                DB::rollback();
                return Redirect::route('index')->with('error','Não foi possivel salvar o email');
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use DateTime;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $stringData = $request->input('data');
        if($stringData != null || $stringData != ''){
            DB::beginTransaction();
            try{
                DB::table('hardware')
                ->insert(['data'=>$stringData,'created_at'=>new DateTime]);
                DB::commit();
                return response()->json(['success'=>'Sucesso de retorno']);
            }catch(\Exception $ex){
                DB::rollback();
                return response()->json(['error'=>'Um erro ocorreu: '.$ex->getMessage()]);
            }
        }else{
                return response()->json(['error'=>'Nenhum dado enviado']);
        }
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

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
        
        $data = DB::table('onoff')->select('*')->orderBy('created_at','desc')->first();
        return response()->json($data->status);
    }

    public function switchLight(Request $request){
        //echo $request->input('status');
       // echo $request->input('status');
        
        try{
        if($request->input('status') =='true'){
            $status = true;  
        }else{
            $status = false;   
        }
        DB::beginTransaction();
            try{
                DB::table('onoff')->insert(['status'=>$status,'created_at'=>new DateTime]);
                DB::commit();
                return response()->json($status);
            }catch(\Exception $ex){
                DB::rollback();
                return response()->json(['error'=>$ex->getMessage]);
            }
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);   
        }
        
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
        $stringData = $request->all();
        $stringData = json_encode($stringData);
        
        //return response()->json(['chegou'=>$stringData]);
        try{
               
            if($stringData != null || $stringData != '' && count($stringData) < 20){
                DB::beginTransaction();
                try{
                    DB::table('hardware')
                    ->insert(['data'=>$stringData,'created_at'=>new DateTime]);
                    DB::commit();

                    $data = DB::table('onoff')->select('*')->orderBy('created_at','desc')->first();
                    if(is_null($data)){
                       $data->status = 0;
                    }
                    return response()->json($data->status);
                }catch(\Exception $ex){
                    DB::rollback();
                    return response()->json(['error'=>'Um erro ocorreu: '.$ex->getMessage()]);
                }
            }else{
                    return response()->json(['error'=>'Nenhum dado enviado ou acima de 20 caracteres']);
            }
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);   
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
    
    public function getData(){
        
        $now = DateTime::createFromFormat('d/m/Y H:i:s',date('d/m/Y H:i:s'));
        $data = DB::table('hardware')->select('*')->orderBy('created_at','desc')->take(10)->get();
        return response()->json(['data'=>$data]);
        
    }
    
    public function getLastHourData()
    {
        $now =  DateTime::createFromFormat('d/m/Y H',date('d/m/Y H'));
        $lastHour = $now->getTimeStamp()-3600;
        $lastHour =  DateTime::createFromFormat('d/m/Y H',date('d/m/Y H',$lastHour));
        $lastHourData = DB::table('hardware')->select('*')->where('created_at','<',$now)->where('created_at','>=',$lastHour)->get();
        $nowData = DB::table('hardware')->select('*')->where('created_at','>',$now)->get();
        $arrayData = ['nowData'=>$nowData,'lastHourData'=>$lastHourData];
        return response()->json(['data'=>$arrayData]);
    }
}

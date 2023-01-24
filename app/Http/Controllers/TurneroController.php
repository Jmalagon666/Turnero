<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\turno;
use App\Models\area;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;


class TurneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$turnos=turno::all();
        $turnos=turno::orderBy("id","DESC")->take(10)->get();
        $id=turno::orderBy("id","DESC")->take(1)->first();

        return view('turnero.index',compact('turnos','id'));
        //return $turno;
    }

    public function usu_tur(){
        $turno_usu=user::where('id',Auth::user()->id);

        /*$dato_area=area::where('id',1)->first();*/
        return view('dashboard',compact('turno_usu'));
    }

    public function general(request $request){
        /*dd($request->general);*/
        return view('turnero.general',compact('request'));
    }

    public function general_1(request $request){
        /*dd($request->general);*/
        return view('turnero.general_1',compact('request'));
    }

    public function admisiones(request $request){
        /*dd($request->general);*/
        return view('turnero.admisiones',compact('request'));
    }



/*    public function login(request $request){
        dd($request->general);
        return view('turnero.login',compact('request'));
    }*/

    public function usuario(){
        $turnos=turno::all();
        $area=area::all();
        $to_turnos=turno::all()->count();
        return view('turnero.usuario',compact('turnos','area','to_turnos'));

    }



      public function dashboard(){
        $turnos=turno::all();
        $area=area::all();
        $to_turnos=turno::all()->count();
        $tur=User::where('id',Auth::user()->id)->first();
        if($tur->id==null){
            $tur=" ";
        }
        return view('dashboard',compact('turnos','area','to_turnos','tur'));

    }

    public function consultaexterna(request $request){
        return view('turnero.consultaexterna',compact('request'));
    }

    public function cita(request $request){
        return view('turnero.cita',compact('request'));
    }

    public function principal(request $request){
        return view('turnero.principal',compact('request'));
    }

    public function principal_1(request $request){
        return view('turnero.principal_1',compact('request'));
    }

    public function inicio(request $request){
        return view('turnero.inicio',compact('request'));
    }

    public function ingresardocumento(request $request){
        $id=turno::orderBy("id","DESC")->take(1)->first();
       //$id=turno::select('id from turnos order by id desc limit 1')->get();
        return view('turnero.ingresardocumento',compact('id','request'));
    }

    public function ingresardocumento_1(request $request){
        $id=turno::orderBy("id","DESC")->take(1)->first();
       //$id=turno::select('id from turnos order by id desc limit 1')->get();
        return view('turnero.ingresardocumento_1',compact('id','request'));
    }

    public function tomardoc_post(request $request){
        return view('turnero.principal',compact('request'));
    }

    public function tomardoc_post_1(request $request){
        return view('turnero.principal_1',compact('request'));
    }


/*
    public function cardiologia(){
        return view('turnero.ingresardocumento');
    }
    ingresardocumento
*/



    /**
     *
    public function cardiologia(){
        return view('turnero.ingresardocumento');
    }

    public function reabilitacion(){
        return view('turnero.ingresardocumento');
    }
     *
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {


        $dato_turno = request()->except('_token');
        $prueba = new turno();



        if ($request->turno=="GCC") {

            $especialidad="CARDIOLOGÍA";

            $id=area::orderBy("GCC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GCC" => $t]);
            }else{
                $t=$id->GCC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GCC=$t;
                $dato_area->save();
            }

        } else if ($request->turno=="GCME"){

            $especialidad="MEDICINA EXTERNA";

            $id=area::orderBy("GCME","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GCME" => $t]);
            }else{
                $t=$id->GCME;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GCME=$t;
                $dato_area->save();
            }

        }else if ($request->turno=="GCN"){

            $especialidad="NEUROLOGÍA";

            $id=area::orderBy("GCN","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GCN" => $t]);
            }else{
                $t=$id->GCN;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GCN=$t;
                $dato_area->save();
            }

        }else if ($request->turno=="GCOE"){

            $especialidad="OTRAS ESPECIALIDADES";

            $id=area::orderBy("GCOE","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GCOE" => $t]);
            }else{
                $t=$id->GCOE;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GCOE=$t;
                $dato_area->save();
            }

        }else if ($request->turno=="GRC"){

            $especialidad="REHABILITACIÓN CARDÍACA";

            $id=area::orderBy("GRC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GRC" => $t]);
            }else{
                $t=$id->GRC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GRC=$t;
                $dato_area->save();
            }


        }else if ($request->turno=="GEC"){
            $especialidad="EXAMENES DE CARDIOLOGÍA";

            $id=area::orderBy("GEC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GEC" => $t]);
            }else{
                $t=$id->GEC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GEC=$t;
                $dato_area->save();
            }

        } else if ($request->turno=="PCME"){
            $especialidad="MEDICINA EXTERNA";

            $id=area::orderBy("PCME","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PCME" => $t]);
            }else{
                $t=$id->PCME;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PCME=$t;
                $dato_area->save();
            }
        }else if ($request->turno=="PCN"){
            $especialidad="NEUROLOGÍA";

            $id=area::orderBy("PCN","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PCN" => $t]);
            }else{
                $t=$id->PCN;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PCN=$t;
                $dato_area->save();
            }
        }else if ($request->turno=="PCOE"){
            $especialidad="OTRAS ESPECIALIDADES";

            $id=area::orderBy("PCOE","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PCOE" => $t]);
            }else{
                $t=$id->PCOE;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PCOE=$t;
                $dato_area->save();
            }
        }else if ($request->turno=="PRC"){
            $especialidad="REHABILITACIÓN CARDÍACA";

            $id=area::orderBy("PRC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PRC" => $t]);
            }else{
                $t=$id->PRC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PRC=$t;
                $dato_area->save();
            }
        }else if ($request->turno=="PEC"){
            $especialidad="EXAMENES DE CARDIOLOGÍA";

            $id=area::orderBy("PEC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PEC" => $t]);
            }else{
                $t=$id->PEC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PEC=$t;
                $dato_area->save();
            }
        }else if ($request->turno=="PCC"){
            $especialidad="CARDIOLOGÍA";
            $vista_tur=1;

            $id=area::orderBy("PCC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PCC" => $t]);
            }else{
                $t=$id->PCC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PCC=$t;
                $dato_area->save();
            }
        }elseif ($request->turno=="GA") {
            $especialidad="asi cita";
            $vista_tur=2;

            //$id=area::orderBy("PCC","DESC")->take(1)->first();
            $id=1;

            if ($id==null) {
                $t=1;
                //$dato_area=area::where('id',1)->first();
                //area::create(["id" => $t,"GA" => $t]);
            }else{
                $t=$id;
                //$t=$t+1;
                //$dato_area=area::where('id',1)->first();
                //$dato_area->GA=$t;
                //$dato_area->save();
            }
        }else{
            $especialidad="vacia";
        }

        $u=$request->turno;
        $v=$t.$u;
        $request->turno=$v;
        $prueba->turno=$request->turno;
        $prueba->documento=$request->documento;
        $connector = new FilePrintConnector("//172.16.4.33/tmt20");
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo=EscposImage::load("logo1.png",false);
        $printer->bitImage($logo);
        $printer->setTextSize(5, 5);
        $printer -> text($request->turno."\n");
        //dd($request->turno);
        $printer->setTextSize(3, 3);
        $printer -> text($especialidad."\n");
        $printer->feed(1);
        $printer->setTextSize(1, 1);
        $printer->text("Fecha : ".date("d-m-Y")."    Hora :".date("H:i")."\n");
        $printer -> cut();
        $printer -> close();

        //var_dump($datos);
        //dd($dato_turno);
        //dd($prueba);
        //dd($dato_turno);
        turno::create(["turno" => $prueba->turno,"documento" => $prueba->documento]);

 /*       if ($vista_tur=1) {
            return view('turnero.principal');
        } else {
            return view('turnero.principal_1');
        }*/
        return view('turnero.principal');
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
    public function edit(Request $request, $turno)
    {
       /* dd($request->id_usu," ",$turno);
        dd("holaaaaaaaaaaaaaaaaaaaaaaaa");*/
        $tur_usu = Auth::user()->turno;
        $tur_usu=user::where('id',$request->id_usu)->first();
        $tur_usu->turno =$turno;
        $tur_usu->save();

        $tur =turno::where('turno',$turno);
        $tur->delete();

        return redirect()->route('dashboard');
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
        /*dd($request," ",$id);*/
        dd("holaaaaaaaaaaaaaaaaaaaaaaaa");
        /*$tur_usu = Auth::user()->turno;
        $tur_usu=user::where('id',$id)->first();
        dd($tur_usu);
        $tur_usu->turno = "5dfg";
        $tur_usu->save();
        return redirect()->route('dashboard');*/
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tur =turno::where('turno',$id);
        $tur->delete();

        $tur_usu=user::where('turno',$id)->first();
        $tur_usu->turno ="";
        $tur_usu->save();

       return redirect()->route('dashboard');
    }

}

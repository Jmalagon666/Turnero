<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\turno;
use App\Models\area;
use App\Models\User;
use App\Models\informacion;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use App\Models\TcPrint;

use App\Exports\UsersExport;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Case_;

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
        /*dd($request);*/
        $id=turno::orderBy("id","DESC")->take(1)->first();
        $turnoPrint1 = $turnoPrint = $this->validador($request->general);
        $turno=$turnoPrint['turno'];
        /*turno::create(["turno" => $turnoPrint['turno'],"documento" => '99999999']);*/
        $ticket = $this->ticketPrint($turnoPrint['turno'], $turnoPrint['especialidad'], 'TMT2');
        return view('turnero.ingresardocumento',compact('id','request','ticket','turno'));
    }


    public function ingresardocumento_1(request $request){
        $id=turno::orderBy("id","DESC")->take(1)->first();
        $turnoPrint = $this->validador($request->general);
        /* turno::create(["turno" => $turnoPrint['turno'],"documento" => '99999999']); */
        $ticket = $this->ticketPrint($turnoPrint['turno'], $turnoPrint['especialidad'], 'TMT2');
        return view('turnero.ingresardocumento_1',compact('id','request','ticket'));
    }

    public function ticketPrint($position, $category, $print){
        /*
            NOMBRE DE LA IMPRESORA
            Se recomienda:
                - Que sea el mismo nombre para todas las impresoras
                - Que sea una varible parametrizada desde el backup o un archivo de configuracion
        */
        $print_name = $print;

        //  Informacion asociada la la impresion, en este caso un Digi-turno
        $info = array(
            'position' => $position,
            'category' => $category
        );

        //  Genera la estructura de impresion
        $tcprint = new TcPrint();
        $ticket = $tcprint->getTicketPositionInLine($info);

        $result = [
            'print_name' =>$print_name,
            'ticket' => $ticket

        ];

        return $result;
    }

    public function tomardoc_post(request $request){
        $espe= $this->validador($request->turno);

        turno::create(["turno" => $request->tur,"documento" => $request->documento]);
        $date = Carbon::now();
        $fecha=$date->format('Y-m-d');
        informacion::create(["turno" => $request->tur,"hora_inicio" => now()->toTimeString(),"hora_final"=> null,"tipo_turno" => $espe['especialidad'],"fecha"=>$fecha]);
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function validador($request){
        $dato=$request;
        $id=0;
        if ($dato=="GCC") {

            $especialidad="CARDIOLOGIA";

            $id=area::orderBy("GCC","DESC")->take(1)->first();
            //dd($id->GCC);

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
        }else if ($dato=="GCME"){

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
        }else if ($dato=="GCN"){

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
        }else if ($dato=="GCOE"){

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
        }else if ($dato=="GRC"){

            $especialidad="REHABILITACIÓN CARDÍACA";

            $id=area::orderBy("GRC","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                $id=1;
                area::create(["id" => $t,"GRC" => $t]);
            }else{
                $t=$id->GRC;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GRC=$t;
                $dato_area->save();
            }
        }else if ($dato=="GEC"){
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
        }else if ($dato=="PCME"){
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
        }else if ($dato=="PCN"){
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
        }else if ($dato=="PCOE"){
            $especialidad="OTRAS ESPECIALIDADES";

            $id=area::orderBy("PCOE","DESC")->take(1)->first();

            if ($id=0) {
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
        }else if ($dato=="PRC"){
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
        }else if ($dato=="PEC"){
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
        }else if ($dato=="PCC"){
            $especialidad="CARDIOLOGÍA";

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
        }else if ($dato=="GA") {
            $especialidad="IMAGENES";

            $id=area::orderBy("GA","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GA" => $t]);
            }else{
                $t=$id->GA;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GA=$t;
                $dato_area->save();
            }
        }else if ($dato=="GAI") {
            $especialidad="ADMISION IMAGENES DIAGNOSTICAS (PISO 1)";

            $id=area::orderBy("GAI","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GAI" => $t]);
            }else{
                $t=$id->GAI;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GAI=$t;
                $dato_area->save();
            }
        }else if ($dato=="GAU") {
            $especialidad="UNIDAD DIGESTIVA Y RESONANCIA";

            $id=area::orderBy("GAU","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GAU" => $t]);
            }else{
                $t=$id->GAU;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GAU=$t;
                $dato_area->save();
            }
        }else if ($dato=="GER") {
            $especialidad="ENTREGA DE RESULTADOS";

            $id=area::orderBy("GER","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GER" => $t]);
            }else{
                $t=$id->GER;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GER=$t;
                $dato_area->save();
            }
        }else if ($dato=="GL") {
            $especialidad="LABORATORIO";

            $id=area::orderBy("GL","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GL" => $t]);
            }else{
                $t=$id->GL;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GL=$t;
                $dato_area->save();
            }
        }else if ($dato=="GAN") {
            $especialidad="ANGIOGRAFIA";

            $id=area::orderBy("GL","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"GAN" => $t]);
            }else{
                $t=$id->GAN;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->GAN=$t;
                $dato_area->save();
            }
        }else if ($dato=="PA") {
            $especialidad="IMAGENES";

            $id=area::orderBy("PA","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PA" => $t]);
            }else{
                $t=$id->PA;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PA=$t;
                $dato_area->save();
            }
        }else if ($dato=="PAI") {
            $especialidad="ADMISION IMAGENES DIAGNOSTICAS (PISO 1)";

            $id=area::orderBy("PAI","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PAI" => $t]);
            }else{
                $t=$id->PAI;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PAI=$t;
                $dato_area->save();
            }
        }else if ($dato=="PAU") {
            $especialidad="UNIDAD DIGESTIVA Y RESONANCIA";

            $id=area::orderBy("GAU","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PAU" => $t]);
            }else{
                $t=$id->PAU;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PAU=$t;
                $dato_area->save();
            }
        }else if ($dato=="PER") {
            $especialidad="ENTREGA DE RESULTADOS";

            $id=area::orderBy("PER","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PER" => $t]);
            }else{
                $t=$id->PER;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PER=$t;
                $dato_area->save();
            }
        }else if ($dato=="PL") {
            $especialidad="LABORATORIO";

            $id=area::orderBy("PL","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PL" => $t]);
            }else{
                $t=$id->PL;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PL=$t;
                $dato_area->save();
            }
        }else if ($dato=="PAN") {
            $especialidad="ANGIOGRAFIA";

            $id=area::orderBy("PL","DESC")->take(1)->first();

            if ($id==null) {
                $t=1;
                $dato_area=area::where('id',1)->first();
                area::create(["id" => $t,"PAN" => $t]);
            }else{
                $t=$id->PAN;
                $t=$t+1;
                $dato_area=area::where('id',1)->first();
                $dato_area->PAN=$t;
                $dato_area->save();
            }
        }else{
            $especialidad="vacia";
        }

        /*dd($id->$dato);*/
        /*$turno = $id.''.$dato;*/
        /*dd($t);*/
        $turno=$t.''.$dato;
        //dd(' dato = '.$dato);
        /*"dd($turno.'----'.$especialidad);"*/
        return $return = [
            'turno' => $turno,
            'especialidad' => $especialidad
        ];

    }


    public function store(Request $request)
    {

        dd($request->documento);
        $dato_turno = request()->except('_token');
        $prueba = new turno();

        $u=$request->turno;
        $v=$t.$u;
        $request->turno=$v;
        $prueba->turno=$request->turno;
        $prueba->documento=$request->documento;
        /*$connector = new FilePrintConnector("//172.16.4.33/tmt2");
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
        $printer -> close();*/
        /*dd($request->turno,'-',$especialidad,'tmt20');*/


        //dd($request->turno,'--',$especialidad,'--TMT2');

        //dd($ticket);
        //dd($dato_turno);
        //dd($prueba);
        //dd($dato_turno);

        dd('turno = '.$prueba->turno.' docuemto = '.$prueba->documento);
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
    public function edit(Request $request, $turno){

     $inf=json_decode($request->usu);



    $infi = informacion::where('turno',$turno);


    $infi->update
    ([
        'nombre' => $inf->name,
        'taquilla' => $inf->taquilla,
        'hora_final'=>now()->toTimeString(),
    ]);

    $tur_usu = Auth::user()->turno;
    $tur_usu=user::where('id',$inf->id)->first();
    $tur_usu->turno = $turno;
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

    public function eliminar($id){
       /* dd($request); */
        $tur =turno::where('turno',$id);
        $tur->delete();

       return redirect()->route('dashboard');
    }


    public function destroy($id)
    {
       /* dd($id);
        $tur =turno::where('turno',$id);
        $tur->delete();*/

        $tur_usu=user::where('turno',$id)->first();
       /* dd($tur_usu->turno);*/
        $tur_usu->turno="";
        $tur_usu->save();


       return redirect()->route('dashboard');
    }


    public function reporte(){

        return view('turnero.export');
    }

    public function export(){
         return Excel::download(new UsersExport,'Reporte.xlsx');
    }

    public function tablaturno(){
        $turnos=turno::orderBy("id","DESC")->take(10)->get();
        $id=turno::orderBy("id","DESC")->take(1)->first();

        return view('turnero.tablaturno',compact('turnos','id'));
    }




}

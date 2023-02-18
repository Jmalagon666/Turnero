    <x-app-layout>
    <div class="contenedor">
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/usuario.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       {{--  <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css"> --}}
        <script src="https://kit.fontawesome.com/6fe6c76279.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
         <?php
        echo("<meta http-equiv='refresh' content='10'>");
        /*echo date('H:i:s Y-m-d');*/
        ?>
         <title>Usuario</title>

    </head>
    <body>
        <div class="header">
            <div class="row">
                <div class="col">


                </div>
                <div class="col">
                    <div class="mt">
                        <img class="imagen" src="logo.jpg" width="150px" height="90px">
                    </div>
                </div>
                <div class="col">
                    <div class="usuario">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button  >
                                <div>{{ Auth::user()->name }}</div>


                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <h6>     </h6>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card border-success mb-4">
                          <div class="card-header">Configuracion box</div>
                    <div class="card-body">
                    <div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                                <div>Usuario : {{ Auth::user()->name }}</div>
                                <div>Correo : {{ Auth::user()->email }}</div>
                                <div>Modulo : {{ Auth::user()->taquilla }}</div>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->

                        </x-slot>
                    </x-dropdown>
                </div>
                    </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card border-success mb-3">
                          <div class="card-header">Acciones</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card border-success mb-3">
                                <div class="card-header">Llamar nuevo turno</div>
                                <div class="card-body">
                                    <div class="acc3">
                                    <button class="bot" type="button" onclick="leerTexto('{{$tur->turno."."."Modulo".Auth::user()->taquilla}}')">Llamar</button>
                                    </div>
                                    <div  class="acc3" >
									<form action="{{route('turnero.destroy',$tur->turno,2)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="bot" type="submit" value="Finalizar Turno">
                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
              {{--               <div class="col-sm-4">
                                <div class="card border-success mb-3">
                                <div class="card-header">Finalizar Turno</div>
                                <div class="card-body">
                                    <div>
                                        <a class="boton" >Finalizar</a>
                                    </div>
                                    <div>
                                        <a class="boton" href="#">No se presentó</a>
                                    </div>
                                    <div>
                                        <a class="boton" href="#">Derivar</a>
                                    </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-4">
                                <div class="card border-success mb-3">
                                    <div class="card-header">Tiempo de antencion</div>
                                <div class="card-body">
                                <div>
                                    <a class="botonCancelar" href="#">Cancelar LLamado</a>
                                </div>
                                <div>
                                    <a class="boton" href="#">Colocar al final</a>
                                </div>
                                <div>
                                    <a class="boton" href="#">Derivación</a>
                                </div>
                                <div>
                                    <a class="botonVer" href="#">Ver detalle encolados</a>
                                </div>
                                </div>
                                </div>
                            </div> --}}
                            <div class="col-sm-4">
                            <div class="card border-success mb-9">
                          <div class="card-header" >Atendiendo a</div>
                            <div class="card-body">
                                <div>
                                    <input class="acc3" type="text" value="{{$tur->turno}}" name="turno" id="turno">
                                </div>
                            </div>
                    </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
{{--             <h6>Informacion del llamado actual</h6> --}}
        </div>
        <div>
            <div class="row">
                <div class="col-sm-4" >
                    {{-- <div class="card border-success mb-3">
                          <div class="card-header">Atendiendo a</div>
                    <div class="card-body">
                        <div>
                            <input class="boton_acciones" type="text" value="{{$tur->turno}}" name="turno" id="turno">
                        </div>
                    </div>
                    </div> --}}
                </div>
                <div class="col-sm-4">
     {{--                <div class="card border-success mb-3">
                          <div class="card-header">Tiempo de espera</div>
                    <div class="card-body">
                           <h5 class="card-title">Secondary card title</h5>
                    </div>
                    </div> --}}
                </div>
                <div class="col-sm-4">
{{--                     <div class="card border-success mb-3">
                          <div class="card-header">Tiempo de antencion</div>
                    <div class="card-body">
                           <h5 class="card-title">Secondary card title</h5>
                    </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div>
{{--             <h6>Informacion del llamado actual</h6> --}}
        </div>
            <div>
            <div class="row">
                    <div class="col-sm-6">
                        <div class="card border-success mb-3">
                          <div class="card-header">Tramites de Area
                            @foreach($area as $are)
                          <span class="badge">{{$are->GCC+$are->PCC+$are->GEC+$are->PEC+$are->GRC+$are->PRC+$are->GCME+$are->PCME+$are->GCN+$are->PCN+$are->GCOE+$are->PCOE}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                           @endforeach
                          </div>
                          <div class="card-body">
                          <div id="div1">
                            <table>
                                       @foreach($area as $are)
                                    <tr>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Cardiologia
                                            <span class="badge">{{$are->GCC+$are->PCC}}<i class="fa-sharp fa-solid fa-user"></i></span>
                                        </th>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Examenes Cardiologia
                                            <span class="badge">{{$are->GEC+$are->PEC}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                                        </th>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Rehabilitacion Cardiaca
                                            <span class="badge">{{$are->GRC+$are->PRC}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                                        </th>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Medicina Externa
                                            <span class="badge">{{$are->GCME+$are->PCME}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                                        </th>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Neurología
                                            <span class="badge">{{$are->GCN+$are->PCN}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                                        </th>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">
                                            Otra Especialidades
                                            <span class="badge">{{$are->GCOE+$are->PCOE}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                                        </th>

                                    </tr>
                                        @endforeach
                            </table>

                          </div>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-6">
                        <div class="card border-success mb-3">
                            <div class="card-header">Turno en cola
                            <span class="badge">{{$to_turnos}}<i class="fa-sharp fa-solid fa-user"></i> </span>
                            </div>
                            <div class="card-body">
                            <div id="div1">
                            <table>
                                       @foreach($turnos as $turno)
                                    <tr>
                                        <th class="list-group-item d-flex justify-content-between align-items-center">{{$turno->turno}}

                        <div>
                        <table>
                            <tr>
                                <th>
                                    <td >
                                        {{-- <button  class="boton_acciones1" type="button" onclick="leerTexto('{{$turno->turno}}')">Seleccionar</button >--}}

                                        <form action="{{route('turnero.edit',$turno->turno)}}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="{{Auth::user()}}" name="usu">
                                            <input class="boton_acciones1"  type="submit" value="Seleccionar">
                                        </form>

                                    </td>

                                </th>
                                <th>
                                    <td>
                                    <button  class="boton_acciones" type="button" onclick="leerTexto('{{$turno->turno."."."Modulo".Auth::user()->taquilla}}')">llamar</button>
                                    </td>

                                </th>
                                <th>
                                    <td>
                               {{--          <form action="{{route('eliminar')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="boton_acciones" type="submit" value="{{$turno->turno}}">
                                        </form> --}}
                                    </td>
                                </th>
                        </table>
                        </div>
                                        </th>
                                    </tr>
                                        @endforeach
                            </table>
                            </div>
                            </div>
                        </div>
                 </div>
        <script>
   /*         $(document).ready( function () {
                $('#tabla').DataTable();
            } );*/
    </script>
            <script src="js/turnero.js"></script>
            <script type="text/javascript" src="js/datos.js"></script>
            <script type="text/javascript" src="js/voz.js"></script>
    </body>
    </html>

        </div>
    </x-app-layout>

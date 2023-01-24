<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css"> --}}
    <script src="https://kit.fontawesome.com/6fe6c76279.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/datos.js"></script>

    <title>General</title>
</head>
<body Mostrar()>
    <div class="header">
        <div class="row">
            <div class="col">
                <form action="{{route('general_1')}}" method="POST">
                    @csrf
                    <input type="hidden" name="general" value="G" id="n1" >
                    <button class="atras" ><i class="fas fa-arrow-left"></i> Atras</button>
                </form>
            </div>
            <div class="col">
                <div >
                    <img class="imagen" src="logo.jpg" width="150px" height="90px">
                </div>
            </div>
            <div class="col">
                <div>
                    <form action="{{route('principal_1')}}" method="POST">
                        @csrf
                        <button class="siguiente" ><i class="fas fa-solid fa-house"></i> Inicio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="contenido">
            <div class="row">
                <div class="col-sm-6">
                  <div>
                    <div>
                        <form action="{{route('ingresardocumento_1')}}" method="POST">
                        @csrf
                        <input type="hidden" name="general" value="{{$request->general."I"}}" id="n1" >
                        <h2>
                            <button type="submit" value="P" id="n1" class="boton_menu">ADMISION IMAGENES DIAGNOSTICAS (PISO 1)
                            </button>
                        </h2>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                  <div>
                    <div>
                        <form action="{{route('ingresardocumento_1')}}" method="POST">
                        @csrf
                        <input type="hidden" name="general" value="{{$request->general."U"}}" id="n1" >
                        <h2>
                            <button type="submit" value="P" id="n1" class="boton_menu">UNIDAD DIGESTIVA Y RESONANCIA</button>
                        </h2>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        {{$request->general}}
    </div>




</body>
</html>

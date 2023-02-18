<link rel="stylesheet" href="css/turnero.css">
<?php
echo("<meta http-equiv='refresh' content='10'>");
?>
<div class="turnos">
    <table class="content-table" id="tabla">
<div>
        <table>
            <thead>
                <tr>
                    <th style="background: #429c6c;width:370px;height:50px;">TURNO</th>
                    <th  style="background: #429c6c;width:370px;height:50px">MODULO</th>

                </tr>
            </thead>
                   @foreach($turnos as $turno)
                <tr>
                    <th class="dato">{{$turno->turno}}</th>
                    <th class="dato">{{$turno->modulo.$turno->modulo}}</th>
                </tr>
                    @endforeach
        </table>
<div>

</div>
</div>

</div>


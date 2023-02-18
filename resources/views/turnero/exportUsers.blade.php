<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Taquilla</th>
            <th>Turno</th>
            <th>Tipo_turno</th>
            <th>Hora_inicio</th>
            <th>Hora_final</th>
            <th>fecha</th>
            <th>Tiempo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($info as $info)
            <tr>
                <td>{{ $info->id }}</td>
                <td>{{ $info->nombre }}</td>
                <td>{{ $info->taquilla }}</td>
                <td>{{ $info->turno }}</td>
                <td>{{ $info->tipo_turno }}</td>
                <td>{{ $info->hora_inicio }}</td>
                <td>{{ $info->hora_final }}</td>
                <td>{{ $info->fecha }}</td>
                <td>{{ $info->tiempo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles</title>
</head>

<body>
    <h2>Hoteles</h2>
    <a href="{{ url('/add-hotel') }}">Agregar Hotel</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>NIT</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hoteles as $hotel)
                <tr>
                    <td>{{ $hotel->nombre }}</td>
                    <td>{{ $hotel->direccion }}</td>
                    <td>{{ $hotel->ciudad }}</td>
                    <td>{{ $hotel->nit }}</td>
                    <td>
                        <form action="{{ route('hoteles.destroy', $hotel->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

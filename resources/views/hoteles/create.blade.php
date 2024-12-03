<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Hotel</title>
</head>

<body>
    <h2>Agregar Nuevo Hotel</h2>
    <form action="{{ url('/hoteles') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div>
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>
        </div>
        <div>
            <label for="nit">NIT:</label>
            <input type="text" id="nit" name="nit" required>
        </div>
        <div>
            <label for="num_habitaciones">Número de Habitaciones:</label>
            <input type="number" id="num_habitaciones" name="num_habitaciones" required>
        </div>
        <button type="submit">Agregar Hotel</button>
    </form>
</body>

</html>

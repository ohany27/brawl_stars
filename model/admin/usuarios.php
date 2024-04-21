<?php

require_once("../../conexion/conexion.php");

// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión a la base de datos
$con = $database->getConnection();





// Preparar y ejecutar la consulta SQL para mostrar en tabla
$query = $con->prepare("SELECT usuarios.username, usuarios.correo, roles.rol, niveles.nombre_nivel, estado.estado 
    FROM usuarios 
    JOIN roles ON usuarios.id_rol = roles.id_rol 
    JOIN niveles ON usuarios.id_nivel = niveles.id_nivel
    JOIN estado ON usuarios.id_estado = estado.id_estado;
    ");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3">
            <h3 class="text-center text-secondary">Registrar Jugador</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila) : ?>
                        <tr>
                            <td><?php echo $fila['username']; ?></td>
                            <td><?php echo $fila['correo']; ?></td>
                            <td><?php echo $fila['rol']; ?></td>
                            <td><?php echo $fila['nombre_nivel']; ?></td>
                            <td><?php echo $fila['estado']; ?></td>
                            <td>
                            <a href="" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-user-xmark"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
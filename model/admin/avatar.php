<?php
session_start();
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$query = $con->prepare("SELECT avatar.nombre,avatar.foto FROM avatar");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")){

    $nombre = $_POST['nombre'];
    $foto = $_POST['foto'];

    $sql = $con->prepare("SELECT * FROM avatar where nombre='$nombre'");
	$sql->execute();
	$fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($nombre == "" || $foto == "") {
		echo '<script>alert ("Datos Vacios"); </script>';
		echo '<script>window.location="avatar.php"</script>';
	} else if ($fila) {
		echo '<script>alert ("AVATAR YA REGISTRADO"); </script>';
		echo '<script>window.location="avatar.php"</script>';
	} else {
		
		$insertSQL = $con->prepare("INSERT INTO avatar (nombre,foto) 
	  VALUES ('$nombre','$foto')");
		$insertSQL->execute();
		echo '<script>window.location="avatar.php"</script>';
	}

};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Avatar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../css/avatar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post">
            <h3 class="text-center text-secondary">Registrar Avatar</h3>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Avatar</label>
                <input type="text" class="form-control" name="nombre" id="usuario">

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="foto" >

            </div>
            <input type="submit" class="btn btn-primary" name="validar" value="Registrarse">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Nombre</th>                       
                        <th scope="col">Foto</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila) : ?>
                        <tr>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['foto']; ?></td>
                            
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
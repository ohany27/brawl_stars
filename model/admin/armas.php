<?php
session_start();
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$query = $con->prepare("SELECT armas.nombre_arma, armas.dano, armas.imagen_arma, niveles.nombre_nivel 
FROM armas 
JOIN niveles ON armas.id_nivel = niveles.id_nivel
");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")){

    $nombre = $_POST['nombre'];
    $dano = $_POST['dano'];
    $nivel = $_POST['nivel'];

    $foto = $_FILES['foto']['name']; 
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "../../img_bd/" . $foto;

    move_uploaded_file($foto_temp, $foto_destino);

    $sql = $con->prepare("SELECT * FROM armas where nombre_arma='$nombre'");
	$sql->execute();
	$fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($nombre == "" || $dano == "" || $foto_destino == "") {
		echo '<script>alert ("Datos Vacios"); </script>';
		echo '<script>window.location="armas.php"</script>';
	} else if ($fila) {
		echo '<script>alert ("ARMA YA REGISTRADA"); </script>';
		echo '<script>window.location="armas.php"</script>';
	} else {
		
		$insertSQL = $con->prepare("INSERT INTO armas (nombre_arma,dano,imagen_arma,id_nivel) 
	  VALUES ('$nombre','$dano','$foto_destino','$nivel')");
		$insertSQL->execute();
        echo '<script>alert ("REGISTRO EXITOSO"); </script>';
		echo '<script>window.location="armas.php"</script>';
	}

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post" enctype="multipart/form-data">
            <h3 class="text-center text-secondary">Registrar Armas</h3>
            <div class="mb-3">
                <label for="usuario" class="form-label">Arma</label>
                <input type="text" class="form-control" name="nombre">

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Daño</label>
                <input type="text" class="form-control" name="dano">

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Img</label>
                <input type="file" class="form-control" name="foto" accept="image">

            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Nivel</label>
                <select class="form-control" name="nivel">
                    <?php
                    $control = $con->prepare("SELECT id_nivel, nombre_nivel FROM niveles");
                    $control->execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['id_nivel'] . "'>" . $fila['nombre_nivel'] . "</option>";
                    }
                    ?>

                </select>
            </div>

            <input type="submit" class="btn btn-primary" name="validar" value="Registrarse">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
        
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Daño</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nivel</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila) : ?>
                        <tr>
                            <td><?php echo $fila['nombre_arma']; ?></td>
                            <td><?php echo $fila['dano']; ?></td>
                            <td>
                                <img src="<?php echo $fila['imagen_arma']; ?>" alt="Imagen del arma" style="max-width: 100px;">
                            </td>

                            <td><?php echo $fila['nombre_nivel']; ?></td>

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
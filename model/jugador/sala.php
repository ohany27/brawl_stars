<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Partida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../../css/partida.css">
</head>
<body>
    
    <nav class="navbar container">
        <div class="title-container">
            <h1>ATRAPAGEMAS</h1>
            <h3 class="subtitle">TIROTEO ESCOLAR</h3>
        </div>
    </nav>

    <div class="swiper mySwiper container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?php echo $foto_mapa; ?>" alt="Mapa">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box-container">
        <?php
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "brawl_stars";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener el ID del mundo desde el formulario
        $id_mundo = $_POST['id_mundo'] ?? null;

        if ($id_mundo) {
            // Consulta SQL para obtener los jugadores del mundo actual
            $sql = "SELECT usuarios.*, detalle_mundo.id_dmundo, mundos.foto AS foto_mundo
                    FROM usuarios 
                    INNER JOIN detalle_mundo ON usuarios.id = detalle_mundo.id_jugador 
                    INNER JOIN mundos ON detalle_mundo.id_mundo = mundos.id_mundo
                    WHERE detalle_mundo.id_mundo = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_mundo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Mostrar los jugadores y sus datos
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="box">';
                    echo '<div class="imgbx">';
                    // Mostrar la foto del jugador en lugar de la ruta
                    echo '<img src="' . $row['foto'] . '" alt="' . $row['username'] . '">';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<div class="details">';
                    echo '<h2>' . $row['username'] . '</h2>';
                    echo '<p>Correo: ' . $row['correo'] . '</p>';
                    echo '<p>Puntaje: ' . $row['puntaje'] . '</p>';
                    // Aquí puedes mostrar más datos según sea necesario
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron jugadores en este mundo.";
            }
        } else {
            echo "ID del mundo no recibido.";
        }

        // Cerrar la conexión
        $conn->close();
        ?>

        </div>
    </div>

    <div class="formulario">
        <h1>Nombre Jugador</h1>
        <form method="post"  action="controller/inicio.php" id="formulario">
            <div class="campos">
                <h4>Tipo de Arma</h4>
                <select name="id_tipo_arma">
                    <option value="">Seleccione Tipo de arma</option>
                </select>
            </div>
            <div class="campos">
                <h4>Arma</h4>
                <select name="id_arma">
                    <option value="">Seleccione Arma</option>
                </select>
            </div>
            <div class="campos">
                <h4>Objetivo</h4>
                <select name="id_objetivo">
                    <option value="">Seleccione jugador</option>
                </select>
            </div>

            <input type="submit" name="inicio" value="Atacar">
            <br><br>
        </form>
    </div>
    
</body>
</html>

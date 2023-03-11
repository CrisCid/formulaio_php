<!DOCTYPE html>
<?php
require('conexion.php');
// establezco la conexion para que funcione $mysqli
$mysqli = new mysqli("localhost", "root", "", "formulario");

$query = "SELECT id_regiones, nombre_regiones FROM regiones ORDER BY nombre_regiones";
$resultado = $mysqli->query($query);


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous">
        </script>

    <script language="javascript">
        $(document).ready(function () {
            $("#regiones").change(function () {
                $("#regiones option:selected").each(function () {
                    id_regiones = $(this).val();
                    $.post("getComuna.php", { id_regiones: id_regiones }, function (data) {
                        $("#comunas").html(data);
                    });
                });
            })
        });
    </script>
    <?php
    // En esta parte recibe el mensaje si es que se proceso el voto
    session_start();
    if (isset($_SESSION['mensaje'])) {
        echo "<script>alert('" . $_SESSION['mensaje'] . "');</script>";
        unset($_SESSION['mensaje']);
    }
    ?>

</head>

<body>
    <?php

    include("conexion.php")

        ?>
    <?php
    function limpiarFormulario()
    {
        // Código para limpiar los campos del formulario
        $_POST['nombreyapellido'] = '';
        $_POST['alias'] = '';
        $_POST['rut'] = '';
        $_POST['email'] = '';
        // También puedes limpiar cualquier otro valor de sesión que hayas establecido
        unset($_SESSION['mensaje']);
    }
    ?>
    <div>
        <h1>Formulario</h1>
        <form method="POST" action="procesar_voto.php" id="fomulario_votacion">
            <!-- Campo para el nombre y apellido -->
            <label>Nombre y apellido:</label>
            <input type="text" name="nombreyapellido" placeholder="Nombre y Apellido">
            <br>
            <!-- Campo para el Alias -->
            <label>Alias:</label>
            <input type="text" name="alias" placeholder="Alias">
            <br>
            <label>RUT:</label>
            <input type="number" name="rut" placeholder="Rut">
            <br>

            <label>Email:</label>
            <input type="email" name="email" placeholder="ejemplo@ejemplo.com">

            <div>Selecciona Region : <select name="regiones" id="regiones">
                    <option value="0">Seleccionar Region</option>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_regiones']; ?>"><?php echo $row['nombre_regiones']; ?></option>
                    <?php } ?>
                </select></div>

            <br />

            <div>Selecciona Comuna : <select name="comunas" id="comunas"></select></div>

            <br />

            <label>Candidato:</label>
            <select name="candidato">
                <option value="">Seleccione un candidato</option>
                <?php
                $consulta = "SELECT id_candidatos, nombre_candidato from candidatos;";
                $resultado = mysqli_query($connex, $consulta);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value=\"{$fila['id_candidatos']}\">{$fila['nombre_candidato']}</option>";
                }
                ?>
            </select>
            <br>

            <fieldset>
                <legend>¿Cómo se enteró de nosotros?</legend>
                <input type="checkbox" name="opciones[]" value="Web">Web<br>
                <input type="checkbox" name="opciones[]" value="TV">TV<br>
                <input type="checkbox" name="opciones[]" value="Redes Sociales">Redes Sociales<br>
                <input type="checkbox" name="opciones[]" value="Amigo">Amigo<br>
            </fieldset>

            <button type="submit" name="enviar" onclick=limpiarFormulario()> Enviar</button>
        </form>

        <?php
        include("procesar_voto.php");
        ?>

    </div>
</body>

</html>
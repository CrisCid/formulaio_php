<!DOCTYPE html>
<?php
require('conexion.php');
// establezco la conexion para que funcione $mysqli
$mysqli = new mysqli("localhost", "root", "", "formulario");

// se hace la consulta a la base de datos para que se puedan mostrar las regiones en la lista desplegable
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

    <!-- Script para que cada vez que se seleccione una region diferente, 
    se muestren las comunas de la region seleccionada -->
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
    // En esta parte recibe el mensaje si es que se proceso el voto, creando una alerta
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
    <div id="div_formulario" style="margin-top: 25px;">
        <h1>Formulario Votación</h1>
        <form method="POST" action="procesar_voto.php" id="fomulario_votacion">
            <!-- Campo para el nombre y apellido -->
            <label>Nombre y apellido:</label>
            <input type="text" name="nombreyapellido" placeholder="Nombre y Apellido">
            <!--  -->
            <br>
            <br>
            <!-- Campo para el Alias -->
            <label>Alias:</label>
            <input type="text" name="alias" placeholder="Alias">
            <br>
            <!--  -->
            <br>
            <!-- Campo para el Rut -->
            <label>RUT:</label>
            <input type="input" name="rut" placeholder="Rut"
                onkeydown="return /[0-9.\-]/.test(event.key) || event.keyCode === 8"
                onkeyup="autorellenarRut(this)"  maxlength="12">
                <label style="font-size:15px; color:#5D6D7E">Si su rut termina en k, poner 0</label>
            <br>
            <!--  -->
            <br>
            <!-- Campo para el Email -->
            <label>Email:</label>
            <input type="email" name="email" placeholder="ejemplo@ejemplo.com" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
            <br>
            <!--  -->
            <br>
            <!-- Campo para la region -->
            <div
                style="border:none;font-size:20px;font-family: Arial, Helvetica, sans-serif;display:flex; width: 100%;margin-right: 10px;">
                <div style=" border: none;width:100px;">
                    <label>Region :</label>
                </div>
                <select name="regiones" id="regiones" class="regiones" style="flex: 2;margin-left: auto;">
                    <option value="0">Seleccionar Region</option>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_regiones']; ?>"><?php echo $row['nombre_regiones']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <!--  -->
            <!-- Campo para la comuna -->
            <div
                style="border:none;font-size:20px;font-family: Arial, Helvetica, sans-serif;display:flex; width: 100%;margin-right: 10px;">
                <div style=" border: none;width:100px;">
                    <label>Comuna :</label>
                </div>
                <select name="comunas" id="comunas" style="flex: 2;margin-left: auto;"></select>
            </div>
            <br />
            <!--  -->
            <div
                style="border:none;font-size:20px;font-family: Arial, Helvetica, sans-serif;display:flex; width: 100%;margin-right: 10px;">
                <div style=" border: none;width:100px;"><label>Candidato:</label></div>
                <select name="candidato" style="flex: 2;margin-left: auto;">
                    <option value="">Seleccione un candidato</option>
                    <?php
                    // Se hace la consulta a la base de datos para obtener a los candidatos e insertarlos en la lista desplegable
                    $consulta = "SELECT id_candidatos, nombre_candidato from candidatos;";
                    $resultado = mysqli_query($connex, $consulta);
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        echo "<option value=\"{$fila['id_candidatos']}\">{$fila['nombre_candidato']}</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <!--  -->
            <!-- Campo para los checkbox -->
            <fieldset>
                <legend>¿Cómo se enteró de nosotros?</legend>
                <input type="checkbox" name="opciones[]" value="Web">Web
                <input type="checkbox" name="opciones[]" value="TV">TV
                <input type="checkbox" name="opciones[]" value="Redes Sociales">Redes Sociales
                <input type="checkbox" name="opciones[]" value="Amigo">Amigo
            </fieldset>
            <br>
            <br>

            <button type="submit" name="enviar"> Enviar</button>


        </form>
        
        <!-- Script para se autorellene el input de rut con puntos y guiones -->
        <script>
            function autorellenarRut(campo) {
                var rut = campo.value;

                // Quitamos puntos y guiones del valor ingresado
                rut = rut.replace(/\./g, '');
                rut = rut.replace(/\-/g, '');

                // Agregamos puntos y guiones según corresponda
                if (rut.length > 1) {
                    var cuerpo = rut.slice(0, -1);
                    var dv = rut.slice(-1);
                    cuerpo = cuerpo.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    rut = cuerpo + "-" + dv;
                }

                campo.value = rut;
            }
        </script>
        <?php
        include("procesar_voto.php");
        ?>

    </div>
</body>

</html>
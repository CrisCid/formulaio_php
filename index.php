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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Document</title>
    <!-- JQuery -->
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
    <!-- Div con 5 candidatos para que se muestre cuanto % de votos ha recibido -->
    <div id="izquierda" class="izquierda bordes hidden">
        <h3>Cantidad de votos</h3>
        <div class="candidatos">
            <h4>Juan Perez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Juan Perez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Maria Rodriguez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Maria Rodriguez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Pedro Gonzalez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Pedro Gonzalez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Carla Martinez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Carla Martinez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Luisa Gomez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Luisa Gomez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
    </div>
    
    <!-- Formulario de Votacion -->
    <div class="div_formulario">
        <h1>Formulario Votación</h1>
        <form method="POST" action="procesar_voto.php" id="fomulario_votacion" class="fomulario_votacion">
            <!-- Campo para el nombre y apellido -->
            <h4>Nombre y apellido:</h4>
            <input class="espacios_bottom" type="text" name="nombreyapellido" placeholder="Nombre y Apellido">
            <!--  -->
            <!-- Campo para el Alias -->
            <h4>Alias:</h4>
            <input class="espacios_bottom" type="text" name="alias" placeholder="Alias">
            <!--  -->
            <!-- Campo para el Rut -->
            <h4>RUT:</h4>
            <input type="input" name="rut" placeholder="Rut"
                onkeydown="return /[0-9.\-]/.test(event.key) || event.keyCode === 8" onkeyup="autorellenarRut(this)"
                maxlength="12">
            <h6 class="texto_pequeno espacios_bottom alert alert-primary">Si su rut termina en k, poner 0</h6>
            <!--  -->
            <!-- Campo para el Email -->
            <h4>Email:</h4>
            <input class="espacios_bottom" type="email" name="email" placeholder="ejemplo@ejemplo.com"
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
            <!--  -->
            <!-- Campo para la region -->
            <div class="div_combobox espacios_bottom">
                <div class="textos">
                    <h4>Region :</h4>
                </div>
                <select name="regiones" id="regiones" class="desplegable">
                    <option value="0">Seleccionar Region</option>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_regiones']; ?>"><?php echo $row['nombre_regiones']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <!--  -->
            <!-- Campo para la comuna -->
            <div class="div_combobox espacios_bottom">
                <div class="textos">
                    <h4>Comuna :</h4>
                </div>
                <select name="comunas" id="comunas" class="desplegable"></select>
            </div>

            <!--  -->
            <div class="div_combobox espacios_bottom">
                <div class="textos">
                    <h4>Candidato:</h4>
                </div>
                <select name="candidato" class="desplegable">
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
            <button type="submit" name="enviar" class="btn btn-primary"> Enviar</button>
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
    <!-- Div con 5 candidatos para que se muestre cuanto % de votos ha recibido -->
    <div id="derecha" class="derecha bordes hidden">
        <h3>Cantidad de votos</h3>
        <div class="candidatos">
            <h4>Miguel Hernandez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Miguel Hernandez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Sofia Fernandez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Sofia Fernandez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Roberto Ramirez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Roberto Ramirez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Ana Castro</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Ana Castro';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
        <div class="candidatos">
            <h4>Diego Sanchez</h4>
            <div class="progress">
                <?php
                require("conexion.php");
                $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Diego Sanchez';")->fetch_assoc());

                echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                ?>
            </div>
        </div>
    
    </div>
    
    <script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>


</html>
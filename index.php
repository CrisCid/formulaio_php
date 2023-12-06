<!DOCTYPE html>
<?php
$rutaConexion = 'connection/conexion.php';
require($rutaConexion);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
    <!--====== Nombre pagina ======-->
    <title>Formulario</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="images/icon-logo.png" type="image/png">
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
    <script>
        window.addEventListener('beforeunload', function () {
            sessionStorage.clear();
        });

    </script>
    
</head>


<body class="d-flex flex-column align-content-center mt-5" style="align-items: center">
    <!-- Div con 5 candidatos para que se muestre cuanto % de votos ha recibido -->


    <!-- Formulario de Votacion -->
    <div class="col-12 p-2 d-flex conteiner justify-content-around ">
        <div id="izquierda" class="d-flex flex-wrap col-12 col-lg-3 align-items-center mb-4 p-5 text-center bordes borderadio shadow-lg">
            <h3 class="w-100 text-center mb-5">Cantidad de votos</h3>
            <div class="col-12">
                <h4>Juan Perez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Juan Perez';")->fetch_assoc());
                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }


                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Maria Rodriguez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Maria Rodriguez';")->fetch_assoc());
                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }

                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Pedro Gonzalez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Pedro Gonzalez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Carla Martinez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Carla Martinez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Luisa Gomez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Luisa Gomez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div class="col-12 col-lg-4 p-4 div_formulario borderadio shadow-lg">
            <h1 class="display-4 w-100 text-center mb-4">Formulario Votación</h1>
            <form method="POST" action="procesar_voto.php" id="fomulario_votacion" class="">
                <!-- Campo para el nombre y apellido -->
                <label class="from-label fs-6">Nombre y apellido:</label>
                <input class="form-control form-control-sm borderadio " type="text" name="nombreyapellido" placeholder="EJ: Juan Perez"
                    id="nombreyapellido">
                <!--  -->
                <!-- Campo para el Alias -->
                <label class="from-label fs-6">Alias:</label>
                <input class="form-control form-control-sm borderadio" type="text" name="alias" placeholder="EJ: ShadowRunner" id="alias">
                <!--  -->
                <!-- Campo para el Rut -->
                <label class="from-label fs-6">RUT:</label>
                <input class="form-control form-control-sm borderadio" type="input" name="rut" placeholder="12.345.678-9" id="rut"
                    onkeydown="return /[0-9.\-]/.test(event.key) || event.keyCode === 8" onkeyup="autorellenarRut(this)"
                    maxlength="12">
                <h6 class="alert alert-primary mt-2 fs-6 p-2 ">Si su rut termina en k, poner 0</h6>
                <!--  -->
                <!-- Campo para el Email -->
                <label class="from-label fs-6">Email:</label>
                <input class="form-control form-control-sm borderadio" type="email" name="email" placeholder="ejemplo@ejemplo.com" id="email"
                    pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                <!--  -->
                <!-- Campo para la region -->
                <div class="">
                    <div class="">
                        <label class="from-label fs-6">Region :</label>
                    </div>
                    <select name="regiones" id="regiones" class="form-select form-select-sm borderadio" id="region">
                        <option value="0">Seleccionar Region</option>
                        <?php while ($row = $resultado->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_regiones']; ?>">
                                <?php echo $row['nombre_regiones']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!--  -->
                <!-- Campo para la comuna -->
                <div class="">
                    <div class="">
                        <label class="from-label fs-6">Comuna :</label>
                    </div>
                    <select name="comunas" id="comunas" class="form-select form-select-sm borderadio" id="comuna"></select>
                </div>

                <!--  -->
                <div class="">
                    <div class="">
                        <label class="from-label fs-6">Candidato:</label>
                    </div>
                    <select name="candidato" class="form-select form-select-sm borderadio" id="candidato">
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
                    <label class="from-label fs-6">¿Cómo se enteró de nosotros?</label>
                    <div>
                        <input class="form-check-input ms-2 me-1" type="checkbox" name="opciones[]" value="Web"
                            id="opciones">Web
                        <input class="form-check-input ms-2 me-1" type="checkbox" name="opciones[]" value="TV"
                            id="opciones">TV
                        <input class="form-check-input ms-2 me-1" type="checkbox" name="opciones[]"
                            value="Redes Sociales" id="opciones">Redes Sociales
                        <input class="form-check-input ms-2 me-1" type="checkbox" name="opciones[]" value="Amigo"
                            id="opciones">Amigo
                    </div>

                </fieldset>
                <div class="w-100 col-12 d-flex justify-content-center mt-3">
                <button type="submit" name="enviar" class="btn btn-primary btn-lg"> Enviar Voto</button>
                </div>
                
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
        <div id="derecha" class="d-flex flex-wrap col-12 col-lg-3 align-items-center mb-4 p-5 text-center bordes borderadio shadow-lg">
            <h3 class="w-100 text-center mb-5">Cantidad de votos</h3>
            <div class="col-12 ">
                <h4>Miguel Hernandez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Miguel Hernandez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Sofia Fernandez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Sofia Fernandez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                                style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Roberto Ramirez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Roberto Ramirez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Ana Castro</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Ana Castro';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12">
                <h4>Diego Sanchez</h4>
                <div class="progress">
                    <?php
                    require($rutaConexion);
                    $count = current($connex->query("SELECT round(COUNT(*)*100/(SELECT COUNT(*) FROM formulario_voto)) as porcentaje
                FROM formulario_voto v inner join candidatos c
                on c.id_candidatos = v.candidato
                where c.nombre_candidato='Diego Sanchez';")->fetch_assoc());

                    if ($count == 0) {
                        /* echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-label='Animated striped example' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $count . "%'>10%</div>";     */
                        echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-label='Animated striped example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:width:10%;
                    posistion:absolute;
                    margin-left:47%;
                    margin-right:47%;
                    --bs-progress-bar-bg: #0d6dfd00;
                    color: black'>0%</div>";
                    } else {
                        if ($count <= 20) {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        } else {
                            echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar'
                            style='width:" . $count . "%' aria-valuenow='" . $count . "' aria-valuemin='0' aria-valuemax='100'>" . $count . "%</div>";
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>




    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script> -->

    <script>
        window.onload = function () {
            var nombreyapellidoValue = sessionStorage.getItem('nombreyapellidoValue');
            var aliasValue = sessionStorage.getItem('aliasValue');
            var rutValue = sessionStorage.getItem('rutValue');
            var emailValue = sessionStorage.getItem('emailValue');
            var regionesValue = sessionStorage.getItem('regionesValue');
            var comunasValue = sessionStorage.getItem('comunasValue');
            var candidatoValue = sessionStorage.getItem('candidatoValue');
            var opcionesValue = sessionStorage.getItem('opcionesValue');
            if (nombreyapellidoValue && aliasValue && rutValue && emailValue && regionesValue && comunasValue && candidatoValue && opcionesValue) {
                // Si hay un valor en sessionStorage, llenar automáticamente el campo del alias
                document.getElementById('nombreyapellido').value = nombreyapellidoValue;
                document.getElementById('alias').value = aliasValue;
                document.getElementById('rut').value = rutValue;
                document.getElementById('email').value = emailValue;
                document.getElementById('regiones').value = regionesValue;
                document.getElementById('comunas').value = comunasValue;
                document.getElementById('candidato').value = candidatoValue;
                document.getElementById('opciones').value = opcionesValue;
            }

        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>


</html>
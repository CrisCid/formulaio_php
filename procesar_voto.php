<?php
// Incluyo el archivo de conexion
include('conexion.php');

// Verificar si el boton enviar ha sido presionado
if (isset($_POST['enviar'])) {

    // Validar que el input nombreyapellido no quede vacio y tenga mas de 10 caracteres
    if (strlen($_POST['nombreyapellido']) >= 10 && !empty($_POST['nombreyapellido'])) {

        // Verifica que el alias no quede vacio y tenga mas de 5 caracteres
        if (strlen($_POST['alias']) >= 5 && !empty($_POST['alias'])) {

            // Verifica que el rut no quede vacio y tenga mas de 8 caracteres
            if (strlen($_POST['rut']) >= 8 && !empty($_POST['rut'])) {

                // Verificar que no se repita el rut en la base de datos
                $rut = trim($_POST['rut']);
                $consulta_rut = "SELECT * FROM formulario_voto WHERE rut = '$rut'";
                $resultado_rut = $connex->query($consulta_rut);
                if ($resultado_rut->num_rows > 0) {
                    // Si ya existe un registro con el mismo rut, nos dira mediante una alerta que ya voto ese rut
                    echo "<script>alert('Este RUT ya ha votado');</script>";
                } else {

                    // Verifica que email tenga mas de 10 caracteres y no quede vacio
                    if (strlen($_POST['email']) >= 10 && !empty($_POST['email'])) {

                        // Verifica que se seleccionen minimo 2 opciones
                        if (isset($_POST['opciones'])) {
                            
                            $numSeleccionados = count($_POST['opciones']);
                            if ($numSeleccionados >= 2) {
                                // Si se presiono, verificar que los siguientes campos tenga la cantidad de caracteres minimos o iguales mediante la funcion strlen
                                // si es correcto se le asignan los valores del formulario a las siguientes variables
                                $name = trim($_POST['nombreyapellido']);
                                $alias = trim($_POST['alias']);
                                $rut = trim($_POST['rut']);
                                $email = trim($_POST['email']);
                                $region_id = (int) $_POST['regiones'];
                                $comuna_id = (int) $_POST['comunas'];
                                $candidato = trim($_POST['candidato']);
                                $comoseentero = implode(",", $_POST['opciones']);

                                // Luego de asignar los valores a las variables, estas variables se usaran para crear el insert en la tabla formulario_voto
                                $consulta = "INSERT INTO formulario_voto(nombre_votante, alias, rut, email, region_id, comuna_id, candidato, como_se_entero) VALUES ('$name', '$alias', '$rut', '$email', $region_id, $comuna_id, '$candidato', '$comoseentero')";
                                // se ejecuta la consulta a la base de datos y se procede a realizar el insert
                                $resultado = $connex->query($consulta);
                                // Si esta correcto todo lo que se requeria, enviara un mensaje de Procesado
                                if ($resultado) {
                                    session_start();
                                    $_SESSION['mensaje'] = 'Tu voto ha sido procesado';
                                    header('Location: index.php');
                                    exit();
                                } else {
                                    // Si no ha sido procesado el voto enviara el siguiente mensaje
                                    ?>
                                    <h3 class="bad"> Tu voto no ha sido procesado</h3>
                                    <?php
                                }
                            } else {
                                echo "Debes seleccionar al menos dos opciones";
                                error_log("Campos incompletos");
                            }

                        } else {
                            echo "Debes seleccionar al menos una opción";
                        }

                    } else {
                        echo "<script>alert('El Email debe tener un minimo de 10 caracteres y formato email');</script>";
                    }
                }

            } else {
                echo "<script>alert('El Rut debe tener un minimo de 8 numeros');</script>";
            }
        } else {
            echo "<script>alert('El Alias debe tener un minimo de 5 caracteres');</script>";
        }
    } else {
        echo "<script>alert('El Alias debe tener un minimo de 5 caracteres');</script>";
    }
}
?>
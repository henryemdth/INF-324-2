<?php
 session_start();
 if(isset($_GET['edit'])){
    $_SESSION['edit']='edit';
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>INF 323</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- style css -->

    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<!-- <body style="background-color:#CECFC9;width:100%;height:60px;">

    <div style="background-color:#276E90;width:100%;height:60px;">
     -->
    <?php
        $header= $_SESSION['header'];
        $body =$_SESSION['body'];   
     
        echo "<body style='background-color:$body;width:100%;height:60px;'>";
        echo "<div style='background-color:$header;width:100%;height:60px;'>";
    
    ?>
        <div class="col-sm-4">
            <div>
                <?php
                if(!isset($_SESSION['edit'])){
                ?>
                    <ul class="top_button_section flex-row-reverse">
                        <li><a class="login-bt active" href="login.php">Login</a></li>
                        <li><a class="login-bt" href="signup.php">Registrar</a></li>
                    </ul>
                    
                <?php
                }else{
                    echo "<h1 class='container text-white w-100'>EDITAR USUARIO</h1>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="shadow-sm banner_section p-3 my-3 bg-light rounded">
            <?php
                include "./services/conexion.inc.php";
                if(isset($_SESSION['edit'])){
                    $edit =$_GET['edit'];
                    $ci=$_SESSION['ci'];
                    $nombre=$_SESSION['nombre'];
                    $apellido=$_SESSION['apellido'];
                    //$dep=$_SESSION['departamento'];
                    $tipo=$_SESSION['rol'];
                    $correo=$_SESSION['correo'];
                    $password=$_SESSION['password'];
                    if(isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['tipo']) && isset($_POST['apellido']) && isset($_POST['nombre']) && isset($_POST['ci'])){
                        $ci=$_POST['ci'];
                        $nombre=$_POST['nombre'];
                        $apellido=$_POST['apellido'];
                        //$dep=$_POST['departamento'];
                        $tipo=$_POST['tipo'];
                        $correo=$_POST['correo'];
                        $password=$_POST['password'];
                        echo $ci;
                        $resultado = mysqli_query($con, "update persona SET nombre='$nombre',apellido='$apellido',tipo='$tipo',correo='$correo' WHERE ci='$ci';");

                        $resultado2 = mysqli_query($con, "update usuario SET ci='$ci',password=MD5('$password') WHERE ci='$ci';");
                        echo $resultado;
                        echo $resultado2;
                        if(!$resultado && !$resultado2 ){
                            //die("query failed!");
                            $_SESSION['message_type_s']='danger';
                            $_SESSION['message_s']='Error al actualizarse.';
    
                        }else{                       
                           
                            
                            $resultado = mysqli_query($con, "select * from persona where ci='".$ci."';");
                            $fila= mysqli_fetch_array($resultado); 
                            $_SESSION['ci']=$fila['ci'];
                            $_SESSION['nombre'] =$fila['nombre'];
                            $_SESSION['apellido'] =$fila['apellido'];
                            //$_SESSION['departamento'] =$fila['departamento'];
                            $_SESSION['rol'] =$fila['tipo'];
                            $_SESSION['correo']=$fila['correo'];
                            $_SESSION['password']=$password;
                            //header("Cache-Control: no-store, no-cache, must-revalidate");
                            //header("Pragma: no-cache");          
                            header("Location: ./includes/index.php");
                            //die();                  
                            
                        }    
                    }       
                }else{
                    $ci="";
                    $nombre="";               
                    $apellido=""; 
                    $tipo="";                   
                    $password="";
                    $correo="";
                   
                }
                if(isset($_POST['password']) && isset($_POST['tipo']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['ci']) && !isset($_SESSION['edit'])&& isset($_POST['correo'])){
                    $ci=$_POST['ci'];
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    // $fecha=$_POST['fecha'];
                    // $dep=$_POST['departamento'];
                    $tipo=$_POST['tipo'];
                    $correo=$_POST['correo'];
                    $password=$_POST['password'];
                    $resultado = mysqli_query($con, "insert into persona(ci, nombre, apellido, correo,tipo) VALUES ('$ci','$nombre','$apellido','$correo','$tipo');");
                    $resultado2 = mysqli_query($con, "insert into usuario(ci,password) VALUES ('$ci',MD5('$password'));");
                    if(!$resultado && !$resultado2 ){
                        //die("query failed!");
                        $_SESSION['message_type_s']='danger';
                        $_SESSION['message_s']='Error al registrarse.';

                    }else{                     
                      
                        $resultado = mysqli_query($con, "select * from persona where ci='".$_SESSION['ci']."';");
                        $fila= mysqli_fetch_array($resultado);
                        $_SESSION['ci']=$fila['ci'];
                        $_SESSION['nombre'] =$fila['nombre'];
                        $_SESSION['apellido'] =$fila['apellido'];
                        //$_SESSION['departamento'] =$fila['departamento'];
                        $_SESSION['rol'] =$fila['tipo'];
                        $_SESSION['correo']=$fila['correo'];
                        $_SESSION['password']=$password;
                        //header("Cache-Control: no-store, no-cache, must-revalidate");
                        //header("Pragma: no-cache");          
                        header("Location: login.php");
                        //die();                  
                        
                    }                    
                    //$ci=$fila['ci'];
                    //echo mysqli_num_rows($resultado)." si existe";
                    
                }
                if(isset($_SESSION['message_s'])){
                ?>
            <div class="alert alert-<?=$_SESSION['message_type_s']?> alert-dismissible fade show" role="alert">

                <?=$_SESSION['message_s']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php session_unset();
            }?>
            <form method="POST">
                <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Cedula de Identidad</p>
                    </label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Introduzca su C.I." name="ci" value="<?php echo $ci;?>" 
                        <?php
                        if(isset($_SESSION['edit'])){
                            echo "readonly";
                        }
                        ?>
                        >

                </div>
                <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Nombre</p>
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Introduzca su nombre" name="nombre" value="<?php echo $nombre;?>">

                </div>
                <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Apellido</p>
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Introduzca su apellido" name="apellido" value="<?php echo $apellido;?>">

                </div>
                <!-- <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Fecha de nacimiento</p>
                    </label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Introduzca su nombre completo" name="fecha" value="<?phpecho $fecha;?>">

                </div> -->
                <!-- <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Departamento</p>
                    </label>
                </div> -->
                <!-- <div class="form-group" s>
                    <select class="form-control selectpicker" name="departamento">
                        <option selected>Open this select menu</option>
                        <option value="01">Chuquisaca</option>
                        <option value="02">La Paz</option>
                        <option value="03">Cochabamba</option>
                        <option value="04">Oruro</option>
                        <option value="05">Potosi</option>
                        <option value="06">Tarija</option>
                        <option value="07">Santa Cruz</option>
                        <option value="08">Beni</option>
                        <option value="09">Pando</option>

                    </select>
                </div> -->
               
                <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Tipo</p>
                    </label>
                </div>
                <div class="form-group">
                    <select class="form-control selectpicker" name="tipo">
                        <!-- <option selected>Open this select menu</option> -->
                        <option value="Estudiante">Estudiante</option>
                        <option value="Docente">Kardex</option>
                        <option value="Docente">Caja</option>
                    </select>
                </div>
                <br><br><br>
                <div class="form-group">
                    <label for="focusedInput">
                        <p class="text-secondary">Correo electronico</p>
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Introduzca su correo electronico" name="correo" value="<?php echo $correo;?>">

                </div>
                <div class="form-group">
                    <label>
                        <p class="text-secondary">Contraseña</p>
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Introduzca su contraseña" name="password" value="<?php echo $password;?>">
                </div>
                <!-- <input type="hidden" name="ci" value="<?php echo $_SESSION["ci"];?>" /><br> -->
                <button type="submit" class="btn btn-primary bg-info " name="Aceptar" value="Aceptar">INGRESAR</button>
            </form>

        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>

    <script src="js/jquery-3.0.0.min.js"></script>

    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>


</html>
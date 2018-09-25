<?php session_start();
if (!isset($_SESSION["dni"]))
    header("Location: ../login.php");
include_once("../class/class_conexion.php");
$link = new Conexion();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>UNITEC | Bienvenido!</title>
    <link rel="../icon" type="image/png" href="favicon.ico">
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                    <strong>Email: </strong>soporte@unitec.edu
                    &nbsp;&nbsp;
                    <strong>Suporte telefonico: </strong>+504 22280848
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.html">
                    <img src="../assets/img/unitec-logo-mini.png" />
                </a>
            </div>
            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media" id="div-user-settings"></div>
                                <hr />
                                <a href="cerrar_sesion.php" class="btn btn-danger btn-sm">Cerrar sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right"></ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Proyecto Final de la Clase de Bases 1</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>¡Enhorabuena!</b>
                        </div>
                        <div class="panel-body">
                            <p>Sistema que simula un portal sobre AEROPUERTO poniendo en practica todo lo aprendido en la clase de Bases 1</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <b>Tip:</b>
                        </div>
                        <div class="panel-body">
                            <p>Bienvenido! al Sistema navegue y disfrute de nuestro servicio aereo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    IS410 Septiembre, 2018  |  Grupo 5</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/controlador.js"></script>
</body>
</html>

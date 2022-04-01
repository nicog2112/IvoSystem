<?php

require_once "configs.php";


$mensaje = "";

if (isset($_GET['error'])) {
	$error = $_GET['error'];

	if ($error == ERROR_LOGIN_CODE) {

		$mensaje = ERROR_LOGIN_MENSAJE;

	} else if ($error == MENSAJE_CODE) {

		$mensaje = MENSAJE_NECESITA_LOGIN;
		
	}

}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>

  
  <link rel="stylesheet" href="/programacion_3/boutique/css/bootstrap.css">
  <link rel="shortcut icon" href="/programacion_3/boutique/img/logo.ico">
  <style type="text/css">
  img{
    width: 100%;
    height: 100%;
  }
  .login {
    height: 100%;
    width: 100%;
    background-image: linear-gradient(to right top, #9f1764, #a0106c, #a00975, #9e057e, #9c0488, #9a0093, #97009f, #9100ac, #8800bf, #7800d3, #5c10e8, #0021ff);
    position: absolute;
  }
  .login_box {
    width: 1050px;
    height: 600px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #fff;
    border-radius: 10px;
     box-shadow: 20px 20px 20px 20px rgba(0, 0, 0, 0.15);
    display: flex;
    overflow: hidden;
  }
  .login_box .left{
    width: 41%;
    height: 100%;
    padding: 25px 25px;
    
  }
  .login_box .right{
    width: 59%;
    height: 100%  
  }
  .left .top_link a {
    color: #452A5A;
    font-weight: 400;
  }
  .left .top_link{
    height: 20px
  }
  .left .contact{
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
    height: 100%;
    width: 73%;
    margin: auto;
  }
  .left h3{
    text-align: center;
    margin-bottom: 40px;
  }
  .left input {
    border: none;
    width: 80%;
    margin: 15px 0px;
    border-bottom: 1px solid #4f30677d;
    padding: 7px 9px;
    width: 100%;
    overflow: hidden;
    background: transparent;
    font-weight: 600;
    font-size: 14px;
  }
  .left{
    background: linear-gradient(-45deg, #dcd7e0, #fff);
  }
  .submit {
    border: 1px solid #4A038D; /*anchura, estilo y color borde*/
    padding: 15px 70px; /*espacio alrededor texto*/
    border-radius: 10px; /*bordes redondos*/
    display: block;
    margin: auto;
    margin-top: 120px;
    background: #583672;
    color: #fff;
    font-weight: bold;
    box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);


  }

  .submit:hover{
    background: #7D09EA;
    color: #ffffff;
    box-shadow: 0 0 5px #7D09EA;
    border: 1px solid #7D09EA; /*anchura, estilo y color borde*/
    
    
    
  }



  .right {
    background: linear-gradient(212.38deg, rgba(242, 57, 127, 0.7) 0%, rgba(175, 70, 189, 0.71) 100%),url(img/fondoBoutique.jpg);
    color: #fff;
    position: relative;
  }

  .right .right-text{
    height: 100%;
    position: relative;
    transform: translate(0%, 25%);
  }
  .right-text h2{
    display: block;
    width: 100%;
    text-align: center;
    font-size: 50px;
    font-weight: 500;
  }
  .right-text h5{
    display: block;
    width: 100%;
    text-align: center;
    font-size: 19px;
    font-weight: 400;
  }

  .right .right-inductor{
    position: absolute;
    width: 70px;
    height: 7px;
    background: #fff0;
    left: 50%;
    bottom: 70px;
    transform: translate(-50%, 0%);
  }
  .top_link img {
    width: 28px;
    padding-right: 7px;
    margin-top: -3px;
  }




</style>
</head>


<body>
  


  <section class="login">
   
    <div class="login_box">
      <div class="left">
        
        <div class="contact">
          <form form method="POST" action="modulos/usuarios/procesar_login.php">
          <?php if (isset($error)){ ?>  
                <h5 class="alert alert-danger"><?php echo $mensaje; ?></h3>
                <?php } ?>  
           <h3>Iniciar Sesion</h3>
           <input type="text" name="txtUsername" placeholder="Ingrese su Usuario">
           <input type="password" name="txtPassword" placeholder="Ingrese su Contraseña">
           <button class="submit">Iniciar Sesion</button>
         </form>
       </div>
     </div>
     <div class="right">
      <div class="right-text">
        <img src="img/logo2.png" style="width: 100px;
        height: 100px;text:align-center;display:block;
        margin:auto;">
        <h2>IVO SYSTEM</h2>
        <h5>Sistema de Control de stock y Ventas Online</h5>
      </div>
      
    </div>
  </div>
</section>
</body>

</html>
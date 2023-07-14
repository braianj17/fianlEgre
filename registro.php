<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../css/icons/fontawesome/font-awesome.min.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link href="../js/jquery.master/masterslider.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
	<style type="text/css">
		body{background-image:url('assets/images/head-featured-bg.jpg');
			 background-repeat: repeat; 
			 background-size: 100%; }	 
	</style>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php
error_reporting(0);
include_once ("db_params.php");
include_once ("clases/mysql_connection.php");
include_once ("clases/mysqlCommand.php");
include_once ("correo/correo.php");
//MYSQL
$fecha=date('Y-m-d H:i:s');
$con= new ConexionMysql($server_address,$dbuser,$dbpasswd,$db);
//ValidarRegistro
if(isset($_POST['name'])){
		$query = "select * from graduados where email='".$_POST['email']."'";
		$cmd = new ComandosMysql($query, $con->open());
		$datos = $cmd->ExecuteReader(true);
	if ($datos[0]['name'] != ""){
				$msg= "<div style='color: #FF5733;'><h2>Usted ya se encuentra registrado<br><center>Bienvenido ".$datos[0]['name']."</h2></center><br><br></div>";
		}
	else{
		//registro
		$n=strtoupper($_POST['name']);
		$np=strtoupper($_POST['namep']);
		$nm=strtoupper($_POST['namem']);
		$query1 = "insert into graduados (`name`     ,
										  `namep`    , 
										  `namem`    ,  
									      `email`    ,  
									      `telepho`,
									      `price`    ,
									      `specialty`,
									      `date`     ,
									      `notif`    ,
									      `generacion` ) 
							     values(
							     			'".$n."',
							     			'".$np."',
							     			'".$nm."',
											'".$_POST['email']."',
											'".$_POST['telepho']."',
											'',
											'".$_POST['specialty']."',
											'".$fecha."',
							    			'".$_POST['notif']."',
							    			'".$_POST['generacion']."'  )";
		$cmd = new ComandosMysql($query1, $con->open());
		$datos = $cmd->ExecuteNonQuery(true);
		//echo "Devuelto por el Insert:".$datos;
		$id=$cmd->GetId();
		$fActual=date('Y-m-d');
	//$fActual = new DateTime('2017-11-11');
	//echo "<br>".var_dump($fActual);
	/*$fNew='2017-11-3';
	$fNew2='2017-11-9';
	$fNew3='2017-11-10';
	 $fNew = new DateTime($fNew); 
	 $fNew2 = new DateTime($fNew2);
	 $fNew3 = new DateTime($fNew3);
		if($fActual<=$fNew )
		{
		$txt="TIENES EL<b> 50 % </b>DESCUENTO, TU PAGO SERA:<b> $175.00</b><br> VALIDO: FECHA LIMITE DE PAGO 3 DE NOVIEMBRE";
		}
		else if($fActual<=$fNew2)
		{
			$txt="TIENES EL<b> 30 % </b>DESCUENTO, TU PAGO SERA:<b> $245.00 </b><br> VALIDO: FECHA LIMITE DE PAGO 9 DE NOVIEMBRE";
			}
			else if($fActual<=$fNew3)
			{
				$txt="POR SER D&Iacute;A ANTES DEL EVENTO TU PAGO SERA:<b> $350.00 </b><br> VALIDO: FECHA LIMITE DE PAGO 10 DE NOVIEMBRE";
				}
				else 
				{
					$txt="EVENTO VENCIDO";
				}
		*/
		?>
		
		

		<?php
		$msg= "<div style='color: #FF5733;'>
				<h2>Registro realizado con &eacute;xito<br>
					<center>
						Bienvenido ".$n." 
					</center><br>
					
				</h2><br>
				";
		//Envio de Correo
			$correo =  new correo();
			$asunto="Cena de Egresados UVP";
			$contenido="Tú registro fue exitoso. <br> ";
			$contenido .= "<img src=http://egresados.uvp.mx/portada.jpg width='800px' ><br><br><br><br>";
			$mail=$correo->Enviar($_POST['email'],$asunto,$contenido);	
			if ($mail!="Error") {
				$msg='<p align="center"><b>En un momento se enviará un correo de confirmación  .</p>';
			} else {
				$msg='<p align="center">Hubo un error al enviar el correo, por favor inténtelo más tarde.</p>';
			}
	} 



}else{
	$msg="<div style='color: #FF5733;'>
				<h2>Error
					<center>
						Inte de nuevo.
					</center><br>
				</h2>";
}

?>

<div id="body-wrapper" >
<center>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="2">

  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="justify"><?=$msg?></td>
  </tr>
</table>
<br><br><br><br><br><br><br><br>
<meta http-equiv="refresh" content="40;URL=http://egresados.uvp.mx/" /> 

</center>
</div>
</body>
</html>
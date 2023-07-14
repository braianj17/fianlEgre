<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        		<link href="../css/icons/fontawesome/font-awesome.min.css" rel="stylesheet"/>
    			<link href="../css/font-awesome.min.css" rel="stylesheet">
    			<link href="../js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet"/>
    			<link href="../js/jquery.master/masterslider.css" rel="stylesheet"/>
    			<link href="../css/style.css" rel="stylesheet"/>
					<style type="text/css">
						body
						{
							background-image:url('assets/images/head-featured-bg.jpg');
			 				background-repeat: repeat; 
			 				background-size: 100%; 
			 			}	 
					</style>
	  					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		</head>
			<body>
				<?
					include_once ("correo/mail.php");
					// definimos a quien se lo enviamos
					$destino="egresados@uvp.mx";
					$asunto="Formulario de Contacto de Cena de Egresados UVP: ".$_POST['name'];
					$contenido=$_POST['message']."<br /> \r\n ".$_POST['name']." desea respuesta al correo: ".$_POST['email'];
					// verificamos si se envió
					$correo =  new correo();
					$mail=$correo->Enviar($destino,$asunto,$contenido);
						if ($mail!="Error") 
							{
    							$msg='<p align="center"><b>Gracias por su mensaje.</b> En breve nos comunicaremos con usted.</p>';
							} 
								else 
									{
    									$msg='<p align="center">Error '.$_POST['name'].' Intente mas tarde.</p>';
									}
				?>
					<div class="container">
						<div class="row">
							<center>
								<table width="500" border="0" align="center" cellpadding="5" cellspacing="2">
	  								<tr>
										<td>&nbsp;</td>
	  								</tr>
	  									<tr>
											<td align="justify"><?=$msg?></td>
	  									</tr>
								</table>
									<meta http-equiv="refresh" content="2;URL=http://egresados.uvp.mx/" /> 
							</center>
						</div>
					</div>
			</body>
</html>
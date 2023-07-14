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
<div class="container">
	<div class="row">
	<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include_once ("db_params.php");
	include_once ("clases/mysql_connection.php");
	include_once ("clases/mysqlCommand.php");
	//MYSQL

	$con= new ConexionMysql($server_address,$dbuser,$dbpasswd,$db);
	//ValidarRegistro

			$query = "select l1.id,
							 l1.name,
							 l1.namep,
							 l1.namem,
							 l1.email,
							 l1.telepho,
							 l1.notif,
							 l1.specialty,
							 l1.generacion,
							 l1.date,
							 l2.fecha_hora 
					 	from graduados 
					 		as l1 
					 			left join asistencia 
					 				as l2 
					 					on l1.id=l2.graduado_id 
					 						ORDER BY l1.id asc";
			$cmd = new ComandosMysql($query, $con->open());
			$data = $cmd->ExecuteReader(true);
			if(count($data) < 1){
						
						echo $msg = "<h2>No se encontraron datos.</2>";
						
					}else{
						?>
						<h1>Listado de egresados registrados.</h1>
						<table width="90%" class="table">
							<thead>
								<tr style="color:#ffffff; background-color:#FF33B8;">
									<th style="font-size:15px"><div align="center"><strong>#</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Nombre</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Apellido paterno</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Apellido Materno</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Email</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Telefono</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Recibe Notificaciones</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Especialidad</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Generacion</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Fecha</strong></div></th>
									<th style="font-size:15px"><div align="center"><strong>Fecha Asistencia</strong></div></th>
									
								</tr>
							</thead>
							
							<?php
							
							foreach($data as $d)
							{
								echo "<tr>
										<td>".$d['id']."</td>
										<td>".$d['name']."</td>
										<td>".$d['namep']."</td>
										<td>".$d['namem']."</td>
										<td>".$d['email']."</td>
										<td>".$d['telepho']."</td>
										<td>".$d['notif']."</td>
										<td>".$d['specialty']."</td>
										<td>".$d['generacion']."</td>
										<td>".$d['date']."</td>
										<td>".$d['fecha_hora']."</td>
									  <tr>";
							}
							?>
						</table>
						<?php
			}
		
	?>

	<div id="body-wrapper" >
	<a href="excel.php" class="btn btn-success btn-lg" data-toggle="modal">
													<span class="glyphicon glyphicon-download-alt"></span> Descargar a Excel
										</a>
	</div>
	</div>
</div>
</body>
</html>
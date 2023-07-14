<?php
//$excel=$_POST['export']; 
header("Content-type: application/vnd.ms-excel; charset=UTF-16LE"); 
header("Content-disposition: attachment; filename=egresados.xls"); 
include_once ("db_params.php");
include_once ("clases/mysql_connection.php");
include_once ("clases/mysqlCommand.php");
//MYSQL
$con= new ConexionMysql($server_address,$dbuser,$dbpasswd,$db);
//ValidarRegistro
	$query = "select 
				l1.id,
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
						as l2 on l1.id=l2.graduado_id 
							ORDER BY l1.id asc";
		$cmd = new ComandosMysql($query, $con->open());
		$data = $cmd->ExecuteReader(true);
		if(count($data) < 1)
			{			
					echo $msg = "<h2>No se encontraron datos.</2>";
			}
				else
					{
						?>
							<table width="90%" class="table">
								<thead>
									<tr>
										<th style="font-size:15px"><div align="center"><strong>#</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Nombre</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Apellido paterno</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Apellido Materno</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Email</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Telefono</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Recibe Notificaciones </strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Especialidad</strong></div></th>
										<th style="font-size:15px"><div align="center"><strong>Generacion</strong></div></th>
										<th style="font-size:12px"><div align="center"><strong>Fecha</strong></div></th>
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
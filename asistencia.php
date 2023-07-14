<!DOCTYPE html>
  <?php 
    include_once ("clases/mysql_connection.php");
    include_once ("clases/mysqlCommand.php");
    include_once ("db_params.php");
      $congreso="Cena de egresados UVP";
  ?>
  <html lang="es">
    <head>
      <title><?php echo $congreso; ?></title>
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
      <body class="onepage">
        <div id="body-wrapper" >
          <center>
              <h1>
                <?php echo $congreso; ?></h1>
                  <br><br>
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
                      <tr>
                        <td align="center">
                          <form action="" method="POST" accept-charset="utf-8">
                            <input type="text" autofocus name="matricula" id="matricula">
                          </form>  
                        </td>
                      </tr>
                      <tr>
                        <td align="center">
                <?
                  if(isset($_POST['matricula']))
                    {
                      $m= $_POST['matricula'];
                      //MYSQL
                      $con= new ConexionMysql($server_address,$dbuser,$dbpasswd,$db);
                      $sql = "select * from graduados where  id = '$m'";
                      $cmd = new ComandosMysql($sql, $con->open());
                      $datos = $cmd->ExecuteReader(true);
                        if ($datos[0]['name'] != "")
                          {
				                    $id=$datos[0]['id'];  
                            $nombre=$datos[0]['name'];
                            $fecha = date('Y-m-d h:i:s');
				                      if(validacion($m,$con)!=true)
                                {
					                         $query="insert into asistencia (graduado_id,fecha_hora)  values('$id','$fecha');";
					                         $cmd = new ComandosMysql($query, $con->open());
					                         $response = $cmd->ExecuteNonQuery(true);
					                         $msg="<div style='color:green;'>".utf8_decode($m." - ".$nombre)."</div>";
				                        } 
                                  else
                                    {
					                             $msg="<div style='color:red;'>Gafete, Registrado en la asistencia.</div>";
				                            }
                          }
                            else
                              {
                                $msg="Gafete, No existe en el registro.";
                              }
                                print "<h1><b>$msg</b></h1>";
                    }
                ?>
    </td>
  </tr>
</table>
<br><br><br><br><br><br><br><br>    
</center>
</div>        
</body>
</html>
<?php
function validacion($m,$con){
	include_once ("clases/mysql_connection.php");
	include_once ("clases/mysqlCommand.php");
	include_once ("db_params.php");
	$registro=false;
	
              $sql = "select * from asistencia where  graduado_id = '$m'";
              $cmd = new ComandosMysql($sql, $con->open());
              $datos = $cmd->ExecuteReader(true);
			  if($datos[0]['graduado_id'] != ""){
				  $registro=true;
			  }
	return 	$registro;	  
}
?>
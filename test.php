<?
	$id=140;
	$fActual=date('Y-m-d');
	//$fActual = new DateTime('2017-11-11');
		echo "<br>".var_dump($fActual);
	$fNew='2018-11-3';
	$fNew2='2018-11-9';
	$fNew3='2018-11-10';
	 $fNew = new DateTime($fNew); 
	 $fNew2 = new DateTime($fNew2);
	 $fNew3 = new DateTime($fNew3);
		if($fActual<=$fNew ){
			echo $msg="TIENES EL<b> 50 % </b>DESCUENTO, TU PAGO SERA:<b> $175.00</b><br> VALIDO: FECHA LIMITE DE PAGO 3 DE NOVIEMBRE";
		}else if($fActual<=$fNew2){
			echo $msg="TIENES EL<b> 30 % </b>DESCUENTO, TU PAGO SERA:<b> $245.00 </b><br> VALIDO: FECHA LIMITE DE PAGO 9 DE NOVIEMBRE";
			}else if($fActual<=$fNew3)
			{
				echo $msg="POR SER D&Iacute;A ANTES DEL EVENTO TU PAGO SERA:<b> $350.00 </b><br> VALIDO: FECHA LIMITE DE PAGO 10 DE NOVIEMBRE";
				}
				else
				 	{
					echo $msg="EVENTO VENCIDO";
					}
		
?>
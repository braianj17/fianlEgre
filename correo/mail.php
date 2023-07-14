<?php
class correo
    {
        public $result;
        public function Enviar($correo,$asunto,$contenido)
            {
                require("class.phpmailer.php");
                require("class.smtp.php");
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = "programacion@uvp.edu.mx";
                $mail->Password = "Des.Sof.13";
                $mail->From = "programacion@uvp.edu.mx";
                $mail->FromName = utf8_decode("Programación de sistemas");
                $mail->Subject = utf8_decode($asunto);
                $mail->MsgHTML($contenido);
                $mail->AddAddress("$correo", "$correo");
                $mail->IsHTML(true);
                if (!$mail->send())
                    {
                        //echo "Fatal: " . $mail->ErrorInfo;
                        $this->result ="Error";
                    } 
                else 
                    {
                        $this->result ="Susses";
                    }
                //Retorna resultado.
                return $this->result;
            }
    }
?>
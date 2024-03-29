<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv as Dotenv;
$dotenv = Dotenv::createImmutable('../includes/.env');
$dotenv->safeLoad();

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $mail->Body = "

        <html>

        <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');

        h2 {
            font-size: 25px;
            font-weight: 500;
            line-height: 25px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        p {
            line-height: 18px;
        }

        a {
            position: relative;
            z-index: 0;
            display: inline-block;
            margin: 20px 0;
        }

        a button {
            padding: 0.7em 2em;
            font-size: 16px !important;
            font-weight: 500;
            background: #fc93a5;
            color: #ffffff;
            border: none;
            text-transform: uppercase;
            cursor: pointer;
        }

        p span {
            font-size: 12px;
        }

        div p{
            border-bottom: 1px solid #000000;
            border-top: none;
            margin-top: 40px;
        }

        </style>

            <body>

                <h1>AppSalon</h1>
                <h2><p>Hola <strong>" . $this->nombre . "</strong></p> ¡Gracias por registrarte!</h2>

                <p>Para que puedas comenzar a disfrutar los servicios ofrecidos en App Salon, debes confirma tu correo electrónico presionando el siguiente enlace:</p>

                <a href='" . $_ENV['SERVER_HOST'] . "/confirmarCuenta?token=" . $this->token . "'><button>Confirmar Cuenta</button></a>

                <p>Si tu no solicitaste el registro en Appsalon, puedes ignorar este mensaje.</p>

                <div><p></p></div>

                <p><span>Por favor no respondas a este mensaje, este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correos electrónicos entrantes.</span></p>

            </body>

        </html>

        ";

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $mail->Body = "

        <html>

        <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');

        h2 {
            font-size: 25px;
            font-weight: 500;
            line-height: 25px;
        }

        h3 {
            padding: 1.5em 1em;
            background: #000000;
            color: #ffffff;
            font-size: 12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        p {
            line-height: 18px;
        }

        a {
            position: relative;
            z-index: 0;
            display: inline-block;
            margin: 20px 0;
        }

        a button {
            padding: 0.7em 2em;
            font-size: 16px !important;
            font-weight: 500;
            background: #fc93a5;
            color: #ffffff;
            border: none;
            text-transform: uppercase;
            cursor: pointer;
        }

        div p{
            border-bottom: 1px solid #000000;
            border-top: none;
            margin-top: 40px;
        }

        </style>

            <body>

                <h1>AppSalon</h1>
                <h2><p>Hola <strong>" . $this->nombre . "</strong></p></h2>

                <p>Para restablecer tu contraseña y que puedas volver a disfrutar los servicios ofrecidos en App Salon, debes presionar el siguiente enlace:</p>

                <a href='" . $_ENV['SERVER_HOST'] . "/recuperarPassword?token=" . $this->token . "'><button>Recuperar Contraseña</button></a>

                <p>Si tu no solicitaste el cambio de contraseña de tu cuenta en Appsalon, puedes ignorar este mensaje.</p>

                <div><p></p></div>

                <h3><span>Por favor no respondas a este mensaje, este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correos electrónicos entrantes.</span></h3>

            </body>

        </html>

        ";

        //Enviar el mail
        $mail->send();
    }
}

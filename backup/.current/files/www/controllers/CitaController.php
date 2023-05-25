<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    
    public static function index (Router $router) {

        //Verificar que el usuario haya iniciado sesión sino redirigirlo al login
        isAuth();
        
        $router->render('cita/index', [
            'nombre'=> $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);

    }

}

?>
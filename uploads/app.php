<?php

    function autoload($class){
        //Directorios donde se buscan los archivos de clase
        $directories = [
            dirname(__DIR__).'/scripts/db/',
            dirname(__DIR__).'/scripts/user/',
        ];
        //Convierte el nombre de la clase en un nombre de un archivo relativo

        $classFile = str_replace('\\', '/', $class) . '.php';

        // Recorre los dirrectorios y busca el archivo de la clase

        foreach($directories as $directory){
            $file = $directory.$classFile;

            //verifica si el archivo existe y lo carga
            if (file_exists($file)) {
                require $file;
                break;
            }
        }
    }
    spl_autoload_register('autoload');
    
?>
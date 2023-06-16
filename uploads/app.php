<?php
    trait getInstance{
        public static $instance;
        public static function getInstance() {
            $arg = func_get_args();
            $arg = array_pop($arg);
            return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
        }
        function __set($name, $value){
            $this->$name = $value;
        }
       
    }
    function autoload($class){
        //Directorios donde se buscan los archivos de clase
        $directories = [
            dirname(__DIR__).'/scripts/invoice/',
            dirname(__DIR__).'/scripts/client/',
            dirname(__DIR__).'/scripts/product/',
            dirname(__DIR__).'/scripts/seller/',
            dirname(__DIR__).'/scripts/db/',
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

    client::getInstance(json_decode(file_get_contents("php://input"), true));
    // class apibonita{
    //     use getInstance;

    //     function __construct(private $_METHOD, public $_HEADER, private $_DATA){
    //         switch ($_METHOD) {
    //             case 'POST':
    //                 tb_customer::getInstance($_DATA['info']);;
    //                 break;
                
    //             default:
    //                 # code...
    //                 break;
    //         }
    //     }
    // }
    // $data = [
    //     "_METHOD"=>$_SERVER['REQUEST_METHOD'], 
    //     "_HEADER"=> apache_request_headers(), 
    //     "_DATA" => json_decode(file_get_contents("php://input"), true)
    // ];
    // apibonita::getInstance($data);
    

?>
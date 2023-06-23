<?php
    namespace App;
    
    require "../vendor/autoload.php";
    //\App\client::getInstance(json_decode(file_get_contents("php://input"), true))->postClient();
    // \App\client::getInstance(json_decode(file_get_contents("php://input"), true))->getAllClient();

    //\App\seller::getInstance(json_decode(file_get_contents("php://input"), true))->postSeller();
    // \App\seller::getInstance(json_decode(file_get_contents("php://input"), true))->getAllSeller();

    //\App\product::getInstance(json_decode(file_get_contents("php://input"), true))->postProduct();
    // \App\product::getInstance(json_decode(file_get_contents("php://input"), true))->getAllProduct();

    //\App\invoice::getInstance(json_decode(file_get_contents("php://input"), true))->postInvoice();
    //\App\invoice::getInstance(json_decode(file_get_contents("php://input"), true))->getAllInvoice();
    

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
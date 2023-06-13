<?php
    class product{
        use getInstance;
        function __construct(private $Product_code, public $Product_name, public $Quantity, public $Unit_value){
        }
        function __set($name, $value){
            $this->$name = $value;
        }
        function __get($name){
            return this->$name;
        }
    }
?>
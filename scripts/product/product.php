<?php
    class seller{
        use getInstance;
        function __construct(private $Product_code, public $Product_name, public $Quantity, public $Unit_value){

        }
    }
?>
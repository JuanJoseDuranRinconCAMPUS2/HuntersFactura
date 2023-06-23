<?php
    namespace App;
    abstract class credentials{
        //CREDENCIALES CAMPUS
        // protected $host = '172.16.48.204';
        // private $username = 'sputnik';
        // private $password = 'Sp3tn1kC@';
        // protected $dbname = 'db_hunter_facture_JuanJoseD';
        //CREDENCIALES LOCAL
        protected $host = 'localhost';
        private $username = 'root';
        private $password = '';
        protected $dbname = 'db_hunter_facture_JuanJoseD';
        public function __get($name){
            return $this->{$name};
        }
        function __construct(){
            
        }
    }
?>
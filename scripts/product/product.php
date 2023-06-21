<?php
    class product extends connect{
        private $queryPost= 'INSERT INTO tb_product(product_code,product_name,product_quantity,product_Unit_value) VALUES(:code,:name,:quantity,:value)';
        private $queryGetAll = 'SELECT product_code AS "code", product_name AS "name", product_quantity AS "quantity", product_Unit_value AS "value" FROM tb_product';
        private $message;
        use getInstance;
        function __construct(private $Product_code, public $Product_name, public $Quantity, public $Unit_value){parent::__construct();}
        public function postProduct(){
            try {
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("code", $this->Product_code);
                $res->bindValue("name", $this->Product_name);
                $res->bindValue("quantity", $this->Quantity);
                $res->bindValue("value", $this->Unit_value);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function getAllProduct(){
            try {
                $res = $this->conx->prepare($this->queryGetAll);
                $res->execute();
                $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
    }
?>
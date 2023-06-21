<?php
    class seller extends connect{
        private $queryPost= 'INSERT INTO tb_seller(seller) VALUES(:name)';
        private $queryGetAll = 'SELECT id_seller AS "identification", seller AS "salesman" FROM tb_seller';
        private $message;
        use getInstance;
        function __construct(public $Seller){parent::__construct();}
        public function postSeller(){
            try {
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("name", $this->Seller);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function getAllSeller(){
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
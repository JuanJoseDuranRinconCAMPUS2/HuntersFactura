<?php
    namespace App;
    session_start();
    class client extends connect{
        private $queryPost= 'INSERT INTO tb_client(identification,client_name,client_email,client_address,client_phone) VALUES(:cc,:name,:email,:direction,:cellphone)';
        private $queryGetAll = 'SELECT identification AS "cc", client_name AS "name", client_email AS "client_email", client_address AS "client_address", client_phone AS "client_phone" FROM tb_client';
        private $message;
        use getInstance;
        function __construct(private $Identification = 1, public $Full_Name = 1, public $Email = 2, private $Address = 1, private $Phone = 1){parent::__construct();}
        public function postClient(){
            try {
                $_SESSION['id_Client'] = $this->Identification;
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("email", $this->Email);
                $res->bindValue("cc", $this->Identification);
                $res->bindValue("name", $this->Full_Name);
                $res->bindValue("direction", $this->Address);
                $res->bindValue("cellphone", $this->Phone);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function getAllClient(){
            try {
                $res = $this->conx->prepare($this->queryGetAll);
                $res->execute();
                $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(\PDO::FETCH_ASSOC)];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
    }
?>
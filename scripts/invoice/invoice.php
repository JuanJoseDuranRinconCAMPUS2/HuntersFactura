<?php
    namespace App;
    session_start();
    class invoice extends connect{
        private function getLastSellerForeignKey(){
            $getLastSeller = 'SELECT id_seller AS "identification" FROM tb_seller ORDER BY id_seller DESC LIMIT 1;';
            $foreignKeySeller = $this->conx->prepare($getLastSeller);
            $foreignKeySeller->execute();
            return $foreignKeySeller->fetchColumn();
        }
    
        private $queryPost= 'INSERT INTO tb_invoice(n_invoice,invoice_date,fk_identification,fk_id_seller,fk_product_code) VALUES(:numInvoice,:datenowInvoice,:codeClient,:codeSeller,:codeProduct)';
        private $queryGetAll = 'SELECT n_invoice AS "code", invoice_date AS "date", fk_identification AS "cc", fk_id_seller AS "code_seller", fk_product_code AS "product_code" FROM tb_invoice;';
        private $id;
        private $message;
        use getInstance;
        function __construct(public $N_Invoice = 1, public $Invoice_Dat = 1){parent::__construct();}
        public function postInvoice(){
            try {
                $this->id_Client = $_SESSION['id_Client'];
                $this->id_Product = $_SESSION['id_Product'];

                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("numInvoice", $this->N_Invoice);
                $res->bindValue("datenowInvoice", $this->Invoice_Dat);
                $res->bindValue("codeClient", $this->id_Client);
                $res->bindValue("codeSeller", $this->getLastSellerForeignKey());
                $res->bindValue("codeProduct", $this->id_Product);
                $res->execute();
                $this->message = ["Code" => 200+$res->rowCount(), "Message" => "the data were inserted correctly"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
        public function getAllInvoice(){
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
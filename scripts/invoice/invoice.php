<?php
    class invoice extends connect{
        private $getLastSeller = 'SELECT id_seller AS "identification" FROM tb_seller ORDER BY id_seller DESC LIMIT 1;';
        private $getLastClient = 'SELECT identification AS "id" FROM tb_client ORDER BY identification DESC LIMIT 1;';
        private $getLastProduct = 'SELECT product_code AS "codeP" FROM tb_product ORDER BY product_code DESC LIMIT 1;';
        private $queryPost= 'INSERT INTO tb_invoice(n_invoice,invoice_date,fk_identification,fk_id_seller,fk_product_code) VALUES(:numInvoice,:datenowInvoice,:codeClient,:codeSeller,:codeProduct)';
        private $queryGetAll = 'SELECT n_invoice AS "code", invoice_date AS "date", fk_identification AS "cc", fk_id_seller AS "code_seller", fk_product_code AS "product_code" FROM tb_invoice;';
        private $message;
        use getInstance;
        function __construct(public $N_Invoice, public $Invoice_Dat){parent::__construct();}
        public function postInvoice(){
            try {
                $foreignKeySeller = $this->conx->prepare($this->getLastSeller);
                $foreignKeySeller->execute();
                $this->foreignKeySeller = $foreignKeySeller->fetchColumn();

                $foreignKeyClient = $this->conx->prepare($this->getLastClient);
                $foreignKeyClient->execute();
                $this->foreignKeyClient = $foreignKeyClient->fetchColumn();

                $foreignKeyProduct = $this->conx->prepare($this->getLastProduct);
                $foreignKeyProduct->execute();
                $this->foreignKeyProduct = $foreignKeyProduct->fetchColumn();
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("numInvoice", $this->N_Invoice);
                $res->bindValue("datenowInvoice", $this->Invoice_Dat);
                $res->bindValue("codeClient", $this->foreignKeyClient);
                $res->bindValue("codeSeller", $this->foreignKeySeller);
                $res->bindValue("codeProduct", $this->foreignKeyProduct);
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
                $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
    }
    
?>
<?php
    trait sqlUser{
        public $userAll= "SELECT * FROM tb_invoice";
        public $userInsert= "INSERT INTO tb_invoice (n_bill,bill_date,Seller,identification,full_name,email,address,pone) VALUES(:n_bill,:bill_date,:seller,:identification,:full_name,:email,:address,:pone);";
        public $userDelete= "DELETE FROM tb_invoice WHERE n_bill = :n_bill";
        public $userUpdate= "UPDATE tb_invoice SET n_bill = :n_bill, bill_date= :bill_date, Seller=:seller, identification= :identification, full_name=:full_name, email=:email, address=:address, pone=:pone WHERE n_bill = :n_bill;";
        public $userId= "SELECT * FROM tb_invoice WHERE n_bill = :n_bill";
    }



    
    class tb_user extends connect{
        use getInstance;
        use sqlUser;
        function __construct(){
            parent::__construct();
        }
        public function getAllUser(){
            $res = $this->conn->prepare($this->userAll);
            $res->execute();
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($res,JSON_PRETTY_PRINT);
        }
        public function postUser(){
            extract(...func_get_args());
            $res = $this->conn->prepare($this->userInsert);
            $res->bindParam(':n_bill', $n_bill);
            $res->bindParam(':bill_date', $bill_date);
            $res->bindParam(':seller', $seller);
            $res->bindParam(':identification', $identification);
            $res->bindParam(':full_name', $full_name);
            $res->bindParam(':email', $email);
            $res->bindParam(':address', $address);
            $res->bindParam(':pone', $pone);
            try {
                $res->execute();
                $res = $res->rowCount();
            } catch (PDOException $e){
                $res = ["mensaje"=> $e->getMessage()];
            }
            return json_encode($res,JSON_PRETTY_PRINT);
        }
        public function deleteUser(){
            extract(...func_get_args());
            $res = $this->conn->prepare($this->userDelete);
            $res->bindParam(':n_bill', $n_bill);
            $res->execute();
            $res = $res->rowCount();
            return json_encode($res,JSON_PRETTY_PRINT);
        }
        public function putUser(){
            extract(...func_get_args());
            $res = $this->conn->prepare($this->userUpdate);
            $res->bindParam(':n_bill', $n_bill);
            $res->bindParam(':bill_date', $bill_date);
            $res->bindParam(':seller', $seller);
            $res->bindParam(':identification', $identification);
            $res->bindParam(':full_name', $full_name);
            $res->bindParam(':email', $email);
            $res->bindParam(':address', $address);
            $res->bindParam(':pone', $pone);
            $res->execute();
            $res = $res->rowCount();
            return json_encode($res,JSON_PRETTY_PRINT);
        }
        public function getUserId(){
            extract(...func_get_args());
            $res = $this->conn->prepare($this->userId);
            $res->bindParam(':n_bill', $n_bill);
            $res->execute();
            $res = $res->fetch(PDO::FETCH_ASSOC);
            return json_encode($res,JSON_PRETTY_PRINT);
        }
    }
    
?>
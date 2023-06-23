<?php

class factura extends connect{
    private static $message;
    public static function post($data)
    {

        var_dump($data['Bill_Date']);
        try {
            $query = 'INSERT INTO tb_bills(bill_date, client_cc) VALUES(:bill_date,:client_cc)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam("bill_date", $data['Bill_Date']);
            $res->bindParam("client_cc", $data['Identification']);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }
    public static function getAll()
    {
        try {
            $queryGetAll = 'SELECT n_bill , bill_date AS "fecha", fullname AS "cliente" FROM tb_bills';
            $queryGetAll .= ' INNER JOIN tb_clients ON tb_bills.client_cc = tb_clients.cc';
            $res = self::getConnection()->prepare($queryGetAll);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }


    public static function getid($id){
        try {
            $query = 'SELECT n_bill , bill_date AS "fecha", fullname AS "cliente" FROM tb_bills';
            $query .= ' INNER JOIN tb_clients ON tb_bills.client_cc = tb_clients.cc';
            $query .= ' WHERE n_bill = :id';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(':id', $id);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally{
            echo json_encode(self::$message);
        }
    }

    public static function delete($id)
    {
        try {
            $query = 'DELETE FROM tb_bills WHERE n_bill = :id';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(':id', $id);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(PDO::FETCH_ASSOC) == [] ? 'Done' : $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }

    public static function update($id, $data)
    {
        try {
            $query = 'UPDATE tb_bills SET';
            $params = [];
    
            if ($data['Bill_Date'] !== null) {
                $query .= ' bill_date = :bill_date,';
                $params[':bill_date'] = $data['Bill_Date'];
            }
            if (isset($data['Identification'])) {
                $query .= ' client_cc = :client_cc,';
                $params[':client_cc'] = $data['Identification'];
            }
            
            // Eliminar la coma final del query
            $query = rtrim($query, ',');
    
            $query .= ' WHERE n_bill = :id';
            $params[':id'] = $id;
    
            $res = self::getConnection()->prepare($query);
            $res->execute($params);
    
            $res->rowCount();

            self::$message = ["Code" => 200 , "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }

        
    }
}
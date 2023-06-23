<?php
class cliente extends connect
{
    private static $message;
    public static function postClient($data)
    {
        try {
            $query = 'INSERT INTO tb_clients(cc,fullname,email,address,phone) VALUES(:cc,:name,:email,:direction,:cellphone)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam("email", $data['Email']);
            $res->bindParam("cc", $data['Identification']);
            $res->bindParam("name", $data['Full_Name']);
            $res->bindParam("direction", $data['Address']);
            $res->bindParam("cellphone", $data['Phone']);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }
    public static function getAllClient()
    {
        try {
            $queryGetAll = 'SELECT cc AS "cc", fullname AS "name", email AS "email", address AS "direction", phone AS "cellphone" FROM tb_clients';
            $res = self::getConnection()->prepare($queryGetAll);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }


    public static function getccClient($id){
        try {
            $query = 'SELECT cc AS "cc", fullname AS "name", email AS "email", address AS "direction", phone AS "cellphone" FROM tb_clients ';
            $query .= ' WHERE cc = :id';
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
            $query = 'DELETE FROM tb_clients WHERE cc = :id';
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
            $query = 'UPDATE tb_clients SET';
            $params = [];
    
            if ($data['Full_Name'] !== null) {
                $query .= ' fullname = :fullname,';
                $params[':fullname'] = $data['Full_Name'];
            }
            if ($data['Identification'] !== null) {
                $query .= ' cc = :cc,';
                $params[':cc'] = $data['Identification'];
            }
            if ($data['Email'] !== null) {
                $query .= ' email = :email,';
                $params[':email'] = $data['Email'];
            }
            if ($data['Address'] !== null) {
                $query .= ' direction = :address,';
                $params[':address'] = $data['Address'];
            }
            if ($data['Phone'] !== null) {
                $query .= ' cellphone = :phone,';
                $params[':phone'] = $data['Phone'];
            }
            // Eliminar la coma final del query
            $query = rtrim($query, ',');
    
            $query .= ' WHERE cc = :cc';
            $params[':cc'] = $id;
    
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

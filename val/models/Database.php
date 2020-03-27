<?php

class Database {
    const HOST = '127.0.0.1:3308';
    const DBNAME = 'fight';
    const USERNAME = 'root';
    const PASSWORD = '';
    private static $obj;


    private static function getConn() {

        if(!isset(self::$obj)) {
            self::$obj = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8', self::USERNAME, self::PASSWORD);
        }
        var_dump(self::$obj);
        return self::$obj;
    }


    public static function getAllCharacters() {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters');
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $characters;
    }



    public static function getOneCharacter($id) {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $character = $stmt->fetch(PDO::FETCH_ASSOC);
        return $character;
    }
}

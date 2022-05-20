<?php
require_once "env.php";

class Dbc {

    protected $table_name;

    public static function dbconnect() {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
    
        $dns = "mysql:host=$host; dbname=$dbname; charset=utf8mb4";
    
        try {
            $pdo = new PDO($dns, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch(PDOException $e) {   //エラーの内容が表示されるようになる
            exit($e->getMessage());
        }   
    }

}

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>


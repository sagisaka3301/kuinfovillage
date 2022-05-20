<?php

require_once 'dbc.php';
require_once 'UserLogic.php';

class Info extends Dbc {

    protected $table_name = "classes";

    public static function setUndergra($ungra) {

        if ($ungra === '1') {
            return '経営学部';
        } elseif ($ungra === '2') {
            return '経済学部';
        } elseif ($ungra === '3') {
            return '外国語学部';
        } elseif ($ungra === '4') {
            return '国際日本学部';
        } elseif ($ungra === '5') {
            return '法学部';
        } elseif ($ungra === '6') {
            return '人間科学部';
        } elseif ($ungra === '7') {
            return '理学部';
        } elseif ($ungra === '8') {
            return '工学部';
        } elseif ($ungra === '9') {
            header("Location: class-info.php");
            return 'すべて';
        }
    }

    public function setType($type) {
        if ($type === 1) {
            return '共';
        } elseif ($type === 2) {
            return '専';
        } elseif ($type === 3) {
            return '他';
        }
    }

    public function setStar($star) {
        if ($star === 1) {
            return '★';
        } elseif($star === 2) {
            return '★★';
        } elseif($star === 3) {
            return '★★★';
        } elseif($star === 4) {
            return '★★★★';
        } elseif($star === 5) {
            return '★★★★★';
        } else {
            return '★';
        }
    }
    
    public function reviewCreate($reviews) {

        $sql = "INSERT INTO $this->table_name(undergra, type, class_name, in_charge, evaluation, comment, post_user)
                VALUES (:undergra, :type, :class_name, :in_charge, :evaluation, :comment, :post_user)";

        $dbh = self::dbconnect();

        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':undergra', $reviews['undergra'], PDO::PARAM_INT);
            $stmt->bindValue(':type', $reviews['type'], PDO::PARAM_INT);
            $stmt->bindValue(':class_name', $reviews['class_name'], PDO::PARAM_STR);
            $stmt->bindValue(':in_charge', $reviews['in_charge'], PDO::PARAM_STR);
            $stmt->bindValue(':evaluation', $reviews['rating'], PDO::PARAM_INT);
            $stmt->bindValue(':comment', $reviews['comment'], PDO::PARAM_STR);
            $stmt->bindValue(':post_user', $reviews['post_user'], PDO::PARAM_STR);
            $stmt->execute();
            $dbh->commit();
            echo '評価を投稿しました。';
        } catch (PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }
    // 投稿ユーザーフラグ
    public function postUserFlag($user_id) {
        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE users SET
                    post_flag = :post_flag
                WHERE id = :id";

        $dbh = self::dbconnect();
        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':post_flag', 1, PDO::PARAM_INT);
            $stmt->bindValue(':id', $user_id);
            $stmt->execute();
            $dbh->commit();
        } catch(PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }

    public function getAll() {

        $dbh = self::dbconnect();
    
        $sql = "SELECT * FROM $this->table_name";

        $stmt = $dbh->query($sql);

        $result = $stmt = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
        
    }
    public function findClass($class_name) {

        $dbh = self::dbconnect();

        $sql = "SELECT * FROM $this->table_name Where class_name IN(:name)";
        $dbh->beginTransaction();

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $class_name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);

        if(!$result) {
            header('Location: ../public/find_error.php');
        }
        return $result;
        header('Location: ../public/find.php');
    }

    // idから投稿データを取得 詳細を押したとき実行
    public function getById($id) {
        if (empty($id)) {
            exit('idが不正です。');
        }

        $dbh = self::dbconnect();

        $stmt = $dbh->prepare("SELECT * FROM $this->table_name Where id = :id");
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            exit('投稿がありません。');
        }
        return $result;
    }


    public function searchUndergra($exdata) {

        $dbh = self::dbconnect();

        if ($exdata === '0') {
            header('Location: ../public/class-info.php');
            $dbh = null;

        } else {
            $sql = "SELECT * FROM $this->table_name Where undergra = :undergra";
            $dbh->beginTransaction();

            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':undergra', $exdata, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);

            /*if(!$result) {
                header('Location: ../public/find_error.php');
            }*/
            return $result;
            header('Location: ../public/exclusive.php');
        }

        
    }

    
}


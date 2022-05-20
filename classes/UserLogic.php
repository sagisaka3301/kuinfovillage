<?php
require_once 'dbc.php';

class UserLogic extends Dbc {

    protected $table = 'users';

    /**
     * ユーザーの処理
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData) {
        $result = false;
        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        $dbh = self::dbconnect();

        $arr = [];
        $arr[] = $userData['username']; //name
        $arr[] = $userData['email']; //email
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT); //password
        try {
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
        } catch(\Exception $e) {
            return $result;
        }
    }

    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password) {
        // 結果
        $result = false;
        // ユーザーをemailから検索して取得
        $user_info = self::getUserByEmail($email);

        if (!$user_info) {
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }

        //パスワードの照会
        if (password_verify($password, $user_info['password'])) {
            //ログイン成功
            session_regenerate_id(true); //ハイジャック対策
            $_SESSION['login_user'] = $user_info;
            $login_user = $_SESSION['login_user'];
            //このidを使って、アップデート処理などを行う
            $_SESSION['user_id'] = $login_user['id'];

            $result = true;
            header('Location: ../public/home.php');
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません';
            return $result;

    }
    /**
     * emailからユーザーを取得 (ログイン時利用)
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email) {

        $sql = 'SELECT * FROM users WHERE email = ?';

        // emailを配列に入れる
        $arr = [];
        $arr[] = $email;

        $dbh = self::dbconnect();

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->execute($arr);
            // SQLの結果を返す
            $user_info = $stmt->fetch();
            return $user_info;
        } catch(\Exception $e) {
            return false;
        }
    }

    // idからユーザーを取得
    public static function getUser($user_id) {

        $sql = 'SELECT * FROM users WHERE id = ?';

        // emailを配列に入れる
        $arr = [];
        $arr[] = $user_id;

        $dbh = self::dbconnect();

        try {
            $stmt = $dbh->prepare($sql);
            $stmt->execute($arr);
            // SQLの結果を返す
            $user = $stmt->fetch();
            return $user;
        } catch(\Exception $e) {
            return false;
        }
    }
    // プロフィールアップデート処理
    public static function proUp($get_pro) {

        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE users SET
                    name = :name, email = :email
                WHERE
                    id = :id";


        $dbh = self::dbconnect();

        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':name', $get_pro['name'],PDO::PARAM_STR);
            $stmt->bindValue(':email', $get_pro['email'],PDO::PARAM_STR);
            $stmt->bindValue(':id', $user_id);
            $stmt->execute();
            $dbh->commit();
        } catch(PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }
    // プロフィール画像の更新
    public static function fileSave($filename, $save_path) {

        $id = $_SESSION['user_id'];

        $sql = "UPDATE users SET
                    f_name = :f_name, f_path = :f_path
                WHERE
                    id = :id";


        $dbh = self::dbconnect();

        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':f_name', $filename,PDO::PARAM_STR);
            $stmt->bindValue(':f_path', $save_path,PDO::PARAM_STR);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $dbh->commit();
        } catch(PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }
   
    /**
     * ログインチェック
     * @param void $email
     * @return bool $result
     */
    public static function checkLogin() {

        $result = false;
        //セッションにログインユーザーが入っていなかったらfalse
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;
        }

        return $result;
    }

    /**
     * ログアウト処理
     */
    public static function logout() {
        $_SESSION = array();
        session_destroy();
    }

}


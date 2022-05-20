<?php

require_once "../classes/dbc.php";

//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = './images/';

$save_filename = date('YmdHis') . $filename;
$err_msgs = array();

//複数回使うかもなので、結合したものを変数化。
$save_path = $upload_dir . $save_filename;



//ファイルのバリデーション
//ファイルサイズが1メガバイト以内か・・・超えていたらerror => int(2)が出る
if($filesize > 1048576 || $file_err == 2) {
    array_push($err_msgs, 'ファイルサイズは1MB未満にしてください');
}
//拡張子は画像形式か・・・pathinfoが拡張子の判断に使うPHPの機能
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

//in_arrayは配列の中にあったらtrueなかったらfalseを返す。
//jpegとかのファイル名がもしかしたら大文字になっているので、小文字に直してくれるPHPの機能を使う strtolower

if(!in_array(strtolower($file_ext), $allow_ext)) {
    array_push($err_msgs, '画像ファイルを添付してください');
    echo '<br>';

}

// エラーがなかったら次の処理を実行
if (count($err_msgs) === 0) {
//ファイルがあるかどうか
    if (is_uploaded_file($tmp_path)) {
        if(move_uploaded_file($tmp_path, $save_path)) {
            echo $filename . 'をアップしました。';
            //DBに保存する処理(ファイル名、ファイルパス、キャプション・・・後で消す)
            $result = fileSave($filename, $save_path);

            if ($result) {
                echo '';
            } else {
                echo 'データベースへの保存が失敗しました。';
            }

        } else {
            array_push($err_msgs, 'ファイルが保存されませんでした。');
        }
    } else {
        array_push($err_msgs, 'ファイルが選択されていません');
        echo '<br>';
    }
} else {
    foreach($err_msgs as $msg) {
        echo $msg;
        echo '<br>';
    }
}


?>

<!-- 本番はたぶんmypage.php -->
<a href="../public/mypage.php">戻る</a>
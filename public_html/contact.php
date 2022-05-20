<?php

session_start();

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //危険な文字等を排除する。
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //フォームの送信時にエラーをチェック
    if ($post['name'] === '') {
        $error['name'] = 'blank';
    }

    if ($post['email'] === '') {
        $error['email'] = 'blank';
    } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }

    if ($post['contact'] === '') {
        $error['contact'] = 'blank';
    }

    if (count($error) === 0) {
        //エラーがなければ確認画面に移動
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}

// headの読み込み
$title = 'KU Info Village｜お問い合わせ';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>
<link rel="stylesheet" href="./css/contact.css">
<link rel="stylesheet" href="./css/contact-res.css">
<div class="filter">
    <body>
        <?php include 'header.php'; ?>
        <main>
            <!-- ローディング -->
            <div id="loading">
                <div class="spinner"></div>
            </div>
            <div class="con-title">
                <h3>～お問い合わせ～</h3>
                <h2>Contact</h2>
            </div>
            <div class="complain">
                <p>ご利用いただきありがとうございます。投稿の削除依頼、質問等がありましたら、こちらのフォームをお使いください。適当なご意見でも構いません。</p>
            </div>
            <form action="" method="POST" name="form" onsubmit="return validate()" enctype="multipart/form-data">
                <div class="inner">
                    <div class="name-mail">
                        <div class="name">
                            <label for="">名前</label><br>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($post['name']); ?>" required>
                        </div>
                        <div class="mail">
                            <label for="">メールアドレス</label><br>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="content">
                        <label for="">お問い合わせ内容</label><br>
                        <textarea name="content" id="" placeholder="(例)〇月〇日〇時〇分の投稿を削除してほしい。／自分もアプリ開発に興味がある。など" required></textarea>
                    </div>
                    <div class="s-btn">
                        <input type="submit" class="sub-btn" value="完了">
                    </div>
                </div>
            </form>
        </main>
    <?php include 'footer.php'; ?>
    <script src="./js/detail.js"></script>
    
    
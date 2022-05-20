<?php

session_start();
require_once '../classes/functions.php';
require_once '../classes/UserLogic.php';
$result = UserLogic::checkLogin();
if ($result) {
    header('Location: mypage.php');
    return;
}

if (isset($err['email'])) {
    header('Location: err.php');
}

if (isset($err['password'])) {
    header('Location: err.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="discription" content="神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。">
    <meta property="og:url" content="https://kuinfo123.com" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="KU Info Village" />
    <meta property="og:description" content="神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。" />
    <meta property="og:site_name" content="KU Info Village" />
    <meta property="og:image" content="./img/OGP.jpg" />
    <title>KU-Web</title>
    <link rel="icon" href="./img/k.png">
    <link rel="apple-touch-icon" href="./img/k.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/login-res.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/login.js" defer="defer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="">
    <!-- ローディング -->
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <header></header>
    <main>
        <div class="title">
            <h2>KU Info <br>Village</h2>
        </div>
        <div class="btns">
            <div class="btns-inner">
                <p class='login'>ログイン</p>
                <p class='n-user'>新規ユーザー</p>
            </div>
        </div>
        <div class="new-user-box">
            <form action="register.php" method='POST'>
                <div class="batsu">×</div>
                <div class="user-group">
                    <label for="email">メールアドレス<br></label>
                    <input type="email" name="email" placeholder="メールアドレスを入力" required>
                </div>
                <div class="user-group">
                    <label for="username">新規ユーザー名<br></label>
                    <input type="text" id='username' name="username" required>
                </div>
                <div class="user-group">
                    <label for="password">新規パスワード<br></label>
                    <input type="password" id='password' name='password' required>
                </div>
                <div class="user-group">
                    <label for="password_conf">新規パスワード(確認用)<br></label>
                    <input type="password" id='password_conf' name='password_conf' required>
                </div>
                <div class="comp-btn">
                    <input type="hidden" name='csrf_token' value="<?php echo h(setToken()); ?>">
                    <input type="submit" value='完了'>
                </div>
            </form>
        </div>
        <div class="login-box">
            <form action="login_suc.php" method="POST">
                <div class="batsu-b">×</div>
                <div class="login-group">
                    <label for="">メールアドレス</label>
                    <input type="email" name='email' placeholder='メールアドレスを入力' required>
                </div>
                <div class="login-group">
                    <label for="">パスワード</label>
                    <input type="password" name='password' required>
                </div>
                <div class="comp-btn-b">
                    <input type="submit" value='完了'>
                </div>
            </form>
        </div>
    </main>
    <!-- <script src="login.js"></script> -->
</body>
</html>
<?php 
session_start();
require('../app/dbconnect.php');

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

if ($_COOKIE['email'] !== '') {
  $email = $_COOKIE['email'];
}

if (!empty($_POST)) {
  $email = $_POST['email'];
  
  if ($_POST['email'] !== '' && $_POST['pin'] !== '') {
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND pin=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['pin'])
    ));
    $member = $login->fetch(); //データが返ってきているかを判断する。

    if ($member) {
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      if ($_POST['save'] ==='on') {
        setcookie('email', $_POST['email'], time() + (20 * 365 * 24 * 60 * 60));
      }

      header('Location: ../register/thanks.php');
      exit;
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
 }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reiko reservation</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
<header>
  <div class="header-warapper">
    <div class="main-pic">
      <img id="main-pic" src="../img/bedbug-silhouette.jpg" alt="">
    </div>
    <div class="main-prof">
      <p>貝沼 麗子のご予約サイトへようこそ。</p>
      <p>My passion is ~~~</p>
      <p>I serve you hospitality ~~~</p>
      <p>You can be consulted whenever you'd like to</p>
    </div>
  <div class="error-box">
    <?php if ($error['login'] === 'blank'): ?>
      <p id="error-msg">※正しいメールアドレスとパスワードを入力してください</p>
    <?php endif; ?>
    <?php if ($error['login'] === 'failed'): ?>
      <p id="error-msg">※ログインに失敗しました。正しくご記入ください</p>
    <?php endif; ?>
  </div>
  </div>
</header>

<main>
  <div class="login-container">
    <form action="../../corporate-site/calendar.php" method="post">
      <label for="index-email" class="label1">メールアドレス</label>      
      <label for="index-pin" class="label2">パスワード</label> 
      <br>     
        <input type="email" name="email" id="index-email"
        value="<?php echo h($email); ?>">
        <input type="password" name="pin" id="index-pin"
        value="<?php echo h($_POST['pin']); ?>">
      </br>
      <br>
        <button type="submit" id="index-login">ログイン</button>
      </br>
      <div class="auto-login">
      <input type="checkbox" id="save" name="save" value="on">
      <label for="save">次回から自動的にログインする</label>
      </div>

    </form>
  </div>
  <div class="register-link">
    <p>新規会員登録は<span class="back-color"><a href="register.php">コチラ</a></span>からお願いします。</p>
    <!-- <p>すでに登録がお済みの方は<span class="back-color"><a href="../login/login.php">コチラ</a></span>からログインをお願いします。</p> -->
  </div>
</main>






  <script src="../js/main.js"></script>
</body>
</html>

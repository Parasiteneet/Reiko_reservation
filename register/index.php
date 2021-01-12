<?php 
require('../app/dbconnect.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reiko reservation</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<link rel="stylesheet" href="../css/responsive.css">
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
  </div>
</header>
<main>
  <div class="login-container">
    <form action="">
      <label for="index-email" class="label1">メールアドレス</label>      
      <label for="index-pin" class="label2">パスワード</label> 
      <br>     
        <input type="email" name="email" id="index-email">
        <input type="password" name="pin" id="index-pin">
      </br>
      <br>
        <button type="submit" id="index-login">ログイン</button>
      </br>
    </form>
  </div>

  <div class="register-link">
    <p>新規会員登録は<span class="back-color"><a href="reserve.php">コチラ</a></span>からお願いします。</p>
    <!-- <p>すでに登録がお済みの方は<span class="back-color"><a href="../login/login.php">コチラ</a></span>からログインをお願いします。</p> -->
  </div>
</main>






  <script src="../js/main.js"></script>
</body>
</html>

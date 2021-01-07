
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reiko reservation</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
  <div class="header-warapper">
    <img id="main-pic" src="../img/bedbug-silhouette.jpg" alt="">
    <p>貝沼 麗子のご予約サイトへようこそ。</p>
    <p>My passion is ~~~</p>
    <p>I serve hospitality ~~~</p>
    <p>You can be consulted whenever you'd like to</p>
  </div>
</header>
<main>
  <div class="register">
    <form action="check.php" method="post">
      <div class="centerform">
        名前：<input type="text" name="name" placeholder="名前" class="name">
        メールアドレス：<input type="text" name="email"  placeholder="メールアドレス" class="email">
        パスワード：<input type="password" name="pin"  placeholder="パスワード" class="pin">
        <div id="submit"><input type="submit" value="入力内容を確認する" class="sub"></div>            
      </div>
    </form>
  </div>
</main>






  <script src="../js/main.js"></script>
</body>
</html>

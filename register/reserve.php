<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="register">
  <form action="check.php" method="post">
    <div class="centerform">
      名前：<input type="text" name="name" size="35" maxlength="255" placeholder="名前" class="name">
      メールアドレス：<input type="text" name="email" size="35" maxlength="255" placeholder="メールアドレス" class="email">
      パスワード：<input type="password" name="pin"  size="10" maxlength="20" placeholder="パスワード" class="pin">
      <div id="submit"><input type="submit" value="入力内容を確認する" class="sub"></div>
    </div>
  </form>
</div>

<h3 class="requiredText">上記の必要項目を入力して下さい</h3>


  <script src="../js/main.js"></script>
</body>
</html>
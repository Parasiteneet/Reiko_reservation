<?php
  require('../app/dbconnect.php');


  if ($_POST['name'] === "") {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] === "") {
    $error['email'] = 'blank';
  }

  if ($_POST['pin'] === "") {
    $error['pin'] = 'blank';
  }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>予約フォーム</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>
<div class="register">
  <form action="" method="post">
    <div class="container">
      <div class="item">
          名前：<input type="text" name="name" size="35" maxlength="255" placeholder="名前" class="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES)?>"> 
            <?php if ($error['name'] === 'blank'): ?>
              <script> alert('名前を入力してください'); </script>
            <?php endif; ?>
      </div>
      <div class="item">
          メールアドレス：<input type="text" name="email" size="35" maxlength="255" placeholder="メールアドレス" class="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES)?>">
            <?php if ($error['email'] === 'blank'): ?>
              <script> alert('メールアドレスを入力してください'); </script>
            <?php endif; ?>
      </div>
      <div class="item">
          パスワード：<input type="password" name="pin"  size="10" maxlength="20" placeholder="パスワード" class="pin" value="<?php echo htmlspecialchars($_POST['pin'], ENT_QUOTES)?>">
            <?php if ($error['pin'] === 'blank'): ?>
              <script> alert('パスワードを入力してください'); </script>
            <?php endif; ?>
      </div>
    </div>
      <div id="submit">
        <input type="submit" value="入力内容を確認する" class="sub">
      </div>
  </form>
</div>

<h3 class="requiredText">上記の必要項目を入力して下さい</h3>


  <script src="../js/main.js"></script>
</body>
</html>
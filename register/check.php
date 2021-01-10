<?php 
  require('../app/dbconnect.php');
  session_start();

  if (!isset($_SESSION['join'])) { 
    //セッションの値が渡ってきているか判断
    header('Location: reserve.php');
    exit;
  }

  if (!empty($_POST)) { 
    $stmt = $db->prepare('INSERT INTO members SET name=?, email=?, pin=?, created=NOW()');
    echo $stmt->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      sha1($_SESSION['join']['pin'])
    ));

  unset($_SESSION['join']);//登録後、セッション内のデータを破棄する

  header('Location: thanks.php');
  exit;
}
  
?>  




<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録確認画面</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<form action="" method="post">
  <input type="hidden" name="action" value="submit">

  <?php 
    echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); 
    echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES);
  ?>

  <a href="reserve.php?action=rewrite" action="">書き直す</a>
  <input type="submit" value="登録する" class="sub">


</form>



  <script src="../js/main.js"></script>
</body>
</html>
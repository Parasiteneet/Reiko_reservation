<?php

session_start();

// if(!isset($_SERVER['HTTP_REFERER'])){
//   // redirect them to your desired location
//   header('location:../register/index.php');
//   exit;
// }

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//パラメータを受け取る
$y = isset($_GET['y'])? h($_GET['y']) : '';
$m = isset($_GET['m'])? h($_GET['m']) : '';
$d = isset($_GET['d'])? h($_GET['d']) : '';

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>カレンダー</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class= "reservation-wrapper">
  <div class="reserve-container">
    <div class="reserve-title">
      <h3>RESERVATION</h3>
      <p>ご予約</p>
    </div>
    <form class="reserve-form" method="POST" action="postedReserve.php">
      <div class="form-group">
          <label for="reserveDate"></label>
          <input type="text" class="form-control" id="reserveDate" value="<?php echo $y;?>年<?php echo $m; ?>月<?php echo $d; ?>日" disabled="disabled">
          <!--予約日時を送る-->
          <input type="hidden" name="reserve_date" value="<?php echo $y; ?>-<?php echo $m; ?>-<?php echo $d; ?>"> 
      </div>
      <div class="form-group">
          <label for="name">氏名 *</label>
          <input type="text" class="form-control" name="name" required>
      </div>
      <div class="form-group">
          <label for="tel">電話番号 *</label>
          <input type="text" class="form-control" name="tel" required>
      </div>
      <button type="submit" id="index-login">予約する</button>
    </form>
  </div>
</div>

  
</body>
</html>
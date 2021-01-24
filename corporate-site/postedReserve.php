<?php 


try {
  $db = new PDO('mysql:dbname=reiko_res; host=localhost; charset=utf8', 'root','root');
} catch (PDOException $e) {
  echo 'Data Base Connection Error :' . $e->getMessage();
  exit;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}


$reserve_date = isset($_POST['reserve_date'])? h($_POST['reserve_date']):'';
$name = isset($_POST['name'])? h($_POST['name']):'';
$tel = isset($_POST['tel'])? h($_POST['tel']):'';

if(!empty($_POST)) {
  $stmt = $db->prepare("INSERT INTO reservations (
          reserve_date,
          name.
          tel,
          created_at,
          updated_at
  )values(
          :reserve_date,
          :name,
          :tel,
          now(),
          now()
      )");
    
  $stmt->bindParam(":reserve_date",$reserve_date);
  $stmt->bindParam(":name",$name);
  $stmt->bindParam(":tel",$tel);
  $stmt->execute();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ご予約承りました</title>
</head>
<body>

<div class="wrapper last-wrapper">
            <div class="reserved-container">
                <div class="wrapper-title">
                    <h3>ご予約完了</h3>
                </div>
          <div class="wrapper-body">
              <div class="thanks">
                  <h4>ご相談会のご予約いただきありがとうございます。</h4>
              </div>
              <button type="button" class="btn btn-gray" onclick="location.href='../register/index.php'">トップページに戻る</button>
          </div>
            </div>
        </div>
</body>
</html>
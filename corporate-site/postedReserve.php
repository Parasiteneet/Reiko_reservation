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


$reservation_date = isset($_POST['reservation_date'])? h($_POST['reservation_date']):'';
$name = isset($_POST['name'])? h($_POST['name']):'';
$tel = isset($_POST['tel'])? h($_POST['tel']):'';

if(!empty($_POST)) {
  $stmt = $db->prepare("INSERT INTO reservations(
          reservation_date,
          name,
          tel,
          created_at,
          updated_at
        )values(
          :reservation_date,
          :name,
          :tel,
          now(),
          now()
        )");
    
  $stmt->bindParam(":reservation_date",$reservation_date);
  $stmt->bindParam(":name",$name);
  $stmt->bindParam(":tel",$tel);
  $success = $stmt->execute();


    if($success === true) {
      // メール自動送信 refferd to 
      //https://dezanari.com/mamp-mail/
      //https://ueqareer.net/2721#i-2

        $header = null;
        $auto_reply_subject = null;
        $auto_reply_text = null;
        date_default_timezone_set('Asia/Tokyo');
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $header = "MIME-Version: 1.0\n";
        $header .= "From: Pragin <wumabeatboxer@gmail.com>\n";
        $header .= "Reply-To: Pragin <wumabeatboxer@gmail.com>\n";

        $admin_reply_subject = null;
        $admin_reply_text = null;

        $admin_reply_subject = "予約を受け付けました";
      
        // 本文を設定
        $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
        $admin_reply_text .= "予約日時：" . $_POST['reservation_date'] . "\n";
        $admin_reply_text .= "氏名：" . $_POST['name'] . "\n";
        $admin_reply_text .= "電話番号：" . $_POST['tel'] . "\n\n";

        // 運営側へメール送信
        if(mb_send_mail( 'wumabeatboxer@yahoo.co.jp', $admin_reply_subject, $admin_reply_text,$header)) {
          echo "it succeeded";
        }else{
          echo "it not";
        }
    }else{
        echo 'DBに渡せてないよ。。。';
    }
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
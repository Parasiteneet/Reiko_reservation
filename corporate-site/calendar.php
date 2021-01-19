<?php 
  session_start();

  if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../register/index.php');
    exit;
    //https://www.it-swarm-ja.tech/ja/php/php%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%B8%E3%81%AE%E7%9B%B4%E6%8E%A5url%E3%82%A2%E3%82%AF%E3%82%BB%E3%82%B9%E3%82%92%E9%98%B2%E6%AD%A2%E3%81%99%E3%82%8B/1056077947/ 参照:
}
  
  require 'vendor/autoload.php';
  use Carbon\Carbon;


  function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }
 
  //今日の日付を取得
  // $dt = Carbon::createFromDate(); //今日の 年・月・日・時間を取得
  $m = isset($_GET['m'])? h($_GET['m']) : ''; //$titleから取得するのか?
  $y = isset($_GET['y'])? h($_GET['y']) : '';
  if ($m!= ''||$y!= '') {
    $dt = Carbon::createFromDate($y,$m,01);
  } else {
    $dt = Carbon::createFromDate();
  }
  // renderCalendar($dt);

  //それをファンクションにする
  function renderCalendar($dt) {
    $dt->startOfMonth(); // 今月の最初の日を取得
    $dt->timezone = 'Asia/Tokyo';
    // echo $dt;
  

  //１ヶ月前取得する
  $sub = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
  $subMonth = $sub->subMonth();//前の月を表示するインスタンス
  $subY = $subMonth->year;//前年を取得
  $subM = $subMonth->month;//前の月を取得

  //1ヶ月後取得する
  $add = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
  $addMonth = $add->addMonth();
  $addY = $addMonth->year;
  $addM = $addMonth->month;

   //今月
   $today = Carbon::createFromDate();
   $todayY = $today->year;
   $todayM = $today->month;


  //前月・来月のリンク 取得した上の二つをパラメータに打ち込む
 //リンク
  // $title = '<caption><a href="./calendar.php?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
  // $title .= $dt->format('F Y');//月と年を表示
  // $title .= '<a href="./calendar.php?y='.$addY.'&&m='.$addM.'"> 来月>></a></caption>';//来月リンク  

  $title  = '<h4>'.$dt->format('F Y').'</h4>';//月と年を表示
  $title .= '<div class="month"><caption><a class="left" href="./calendar.php?y='.$todayY.'&&m='.$todayM.'">今月</a>';
  $title .= '<a class="left" href="./calendar.php?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
  $title .= '<a class="right" href="./calendar.php?y='.$addY.'&&m='.$addM.'"> 来月>></a></caption></div>';//来月リンク


  //<table> と<thead> で曜日をぶちこむ
  $headings = array(
    '月','火','水','木','金','土','日'
  );


  // $calendar = '<table class = "table" border=1>';//後でcssで調整する
  $calendar = '<table class="calendar-table">';
  $calendar .='<thead>'; // .=は連結 <table> + <thead>
  foreach($headings as $heading) {
    $calendar .='<th class="header">'.$heading.'</th>';
  }
  $calendar .='</thead>';
 
 //<tbody> で日付を打ち込む
  $calendar .='<tbody><tr>';

  // //今月は何日まであるかをdaysInMontで取得
  $daysInMonth = $dt->daysInMonth;

  for($i = 1; $i <= $daysInMonth; $i++) {
    if($i==1) { //format('N')で1日の曜日を取得
      if ($dt->format('N')!= 1) { //１日のスタートを正しい位置に指定
        $calendar .='<td colspan ="'.($dt->format('N')-1).'"></td>';
        //1日が月曜じゃない場合はcospan(セルを横に結合して)でその分あける
      }
    }

    if($dt->format('N') == 1) {
      $calendar .='</tr><tr>'; //月曜日だったら改行する。条件分岐
    }

    $comp = new Carbon($dt->year."-".$dt->month."-".$dt->day);
    $comp_now = Carbon::today();

    //eq()二つの日時が同じかをチェックできる。
    if($comp->eq($comp_now)) {
      $calendar .='<td class="day" style="background-color:008b8b;">'.$dt->day.'</td>';
     } else {
       switch ($dt->format('N')) {
         case 6:
           $calendar .='<td class = "day" style="background-color:#b0c0e6">'.$dt->day.'</td>';
           break;
         case 7:
           $calendar .='<td class = "day" style="background-color:#f08080">'.$dt->day.'</td>';
           break;
         default:
           $calendar .='<td class = "day">'.$dt->day.'</td>';
           break;
       }
     }


    // $calendar .='<td class="day">'.$dt->day.'</td>';
    $dt->addDay();//次の日を取得する
  }

  $calendar .='</td>'.'</tbody>';

  $calendar .='</table>';

  // echo $title.$calendar;
  return $title.$calendar;
  }


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

<div class="calendar-container">
    <?php echo renderCalendar($dt); ?>
</div>
  
</body>
</html>
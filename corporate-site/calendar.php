<?php 
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
  renderCalendar($dt);

  //それをファンクションにする
  function renderCalendar($dt) {
    $dt->startOfMonth(); // 今月の最初の日を取得
    $dt->timezone = 'Asia/Tokyo';
    // echo $dt;
  }

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

  //前月・来月のリンク 取得した上の二つをパラメータに打ち込む
 //リンク
  $title = '<caption><a href="./calendar.php?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
  $title .= $dt->format('F Y');//月と年を表示
  $title .= '<a href="./calendar.php?y='.$addY.'&&m='.$addM.'"> 来月>></a></caption>';//来月リンク  


  //<table> と<thead> で曜日をぶちこむ
  $headings = array(
    'Monday','Tuesday','Wednesday','Thursday',
    'Friday','Saterday', 'Sunday'
  );


  $calendar = '<table class = "table" border=1>';
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

    $calendar .='<td class="day">'.$dt->day.'</td>';
    $dt->addDay();//次の日を取得する
  }

  $calendar .='</td>'.'</tbody>';

  $calendar .='</table>';

  echo $title.$calendar;


?>
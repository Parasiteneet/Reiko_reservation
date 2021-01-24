<?php 

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}


  $reserve_date = isset($_POST['reserve_date'])? h($_POST['reserve_date']):'';
  $name = isset($_POST['name'])? h($_POST['name']):'';
  $tel = isset($_POST['tel'])? h($_POST['tel']):'';
?>
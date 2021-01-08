<?php 

try {
  $db = new PDO('mysql:dbname=reiko_res; host=localhost; charset=utf8', 'root','root');
} catch (PDOException $e) {
  echo 'Data Base Connection Error :' . $e->getMessage();
}

?> 
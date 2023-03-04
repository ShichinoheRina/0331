<?php 
session_start();

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

  //２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM 0331_r_table");
$status = $stmt->execute();


?>
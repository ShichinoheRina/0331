<?php

$id = $_GET['id'];


try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM 0331_a_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: user.php');
    exit();
}
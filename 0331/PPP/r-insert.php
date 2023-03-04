<?php
$rmail  = $_POST["rmail"];   
$rps  = $_POST["rps"];   
$rname = $_POST["rname"];  

try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

  $stmt = $pdo->prepare("INSERT INTO 0331_r_table(id, rmail, rps, rname)
  VALUES(NULL, :rmail, :rps, :rname)");
  $stmt->bindValue(':rmail', $rmail, PDO::PARAM_STR);
  $stmt->bindValue(':rps', $rps, PDO::PARAM_STR); //数値
  $stmt->bindValue(':rname', $rname, PDO::PARAM_STR);
  $status = $stmt->execute();
  
  if($status==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit("QueryError:".$error[2]);
    }else{
      //５．item.phpへリダイレクト
      header("Location: index.php");
      exit;
    }
  
  
?>


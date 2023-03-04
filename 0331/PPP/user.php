<?php
session_start();
$user_id = $_SESSION['user_id'];


//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }




//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM 0331_a_table WHERE user_id=:user_id");
$stmt -> bindValue(':user_id',$user_id,PDO::PARAM_INT);
$status = $stmt->execute();



//３．データ表示
$view="";
if($status==false) {
 //execute（SQL実行時にエラーがある場合）
 $error = $stmt->errorInfo();
 exit("ErrorQuery:".$error[2]);

} else {
 //Selectデータの数だけ自動でループしてくれる
 while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
         $view .= '<li class="products-item">';
        $view .= '<p class="cart-thumb"><img src="../img/'.$res["fname"].'"
        width="240" height="120" style="border-radius: 5px;"></p>';
        $view .= '<h2 class="title">'.$res["title"].'</h2>';
        // $view .= '<p class="content">'.$res["content"].'</p>';
        $view .= '<a href="detail.php?id='.$res["id"].'" class="btn-update">編集</a>';
        $view .= '<a href="delete.php?id='.$res["id"].'" class="btn-delete">削除</a>';
         $view .= '</li>';
 }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
ログイン
<button class="wbtn" onclick="location.href='./write.php'">書く</button>
<ul class="cart-list">
     <?= $view;?>
 </ul>

</body>
</html>
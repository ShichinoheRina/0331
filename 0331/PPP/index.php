<?php
//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }




//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM 0331_a_table");
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
        $view .= 'お名前';
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
    <link rel="stylesheet" href="../css/index.css">
    <title>Document</title>
</head>
<body>
    <p class="title"> 記事投稿</p>
    <button class="lbtn" onclick="location.href='./login.php'">ログイン</button>
    <button class="tbtn" onclick="location.href='./register.php'">会員登録</button>

    <ul class="cart-list">
            <?= $view;?>
            <?= "お名前"?>
    </ul>
    
</body>
</html>
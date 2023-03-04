<?php

session_start();

//記事のタイトル 受信チェック:title
if(!isset($_POST["title"]) || $_POST["title"]==""){
    exit("ParameError!title!");
}    
//記事の内容 受信チェック:content
if(!isset($_POST["content"]) || $_POST["content"]==""){
    exit("ParameError!content!");
}    



// ファイル受信チェック※$_FILES["******"]["name"]の場合
if(!isset($_FILES["fname"]["name"])|| $_FILES["fname"]["name"]=="") {
    exit("ParameError!files!");
}    

$user_id = $_SESSION['user_id'];
$fname  = htmlspecialchars($_FILES["fname"]["name"], ENT_QUOTES);   //画像File名
$title  = htmlspecialchars($_POST["title"], ENT_QUOTES);   //記事のタイトル
$content  = nl2br(htmlspecialchars($_POST["content"], ENT_QUOTES));   //改行を反映 nl2br
// $content  = $_POST["content"];   //記事の内容





$upload = "../img/"; //画像アップロードフォルダへのパス
//アップロードした画像を../img/へ移動させる記述↓
if(move_uploaded_file($_FILES['fname']['tmp_name'], $upload.$fname)){
  //FileUpload:OK
} else {
  //FileUpload:NG
  echo "Upload failed";
  echo $_FILES['fname']['error'];
}



try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

  
$stmt = $pdo->prepare("INSERT INTO 0331_a_table(id, user_id, title, content, fname,
indate )VALUES(NULL, :user_id, :title, :content, :fname, sysdate())");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR); //数値
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }else{
    //５．item.phpへリダイレクト
    header("Location: user.php");
    exit;
  }

?>
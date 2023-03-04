<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値を受け取る
$rmail = $_POST['rmail'];
$rps = $_POST['rps'];

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=first;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }

//2. データ登録SQL作成
// gs_user_tableに、IDとPWがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM
                        0331_r_table
                        WHERE rmail = :rmail AND rps = :rps');
$stmt->bindValue(':rmail', $rmail, PDO::PARAM_STR);
$stmt->bindValue(':rps', $rps, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if ($status === false) {
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

// if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
  if( $val['id'] != ''){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['user_id'] = $val['id'];
    // $_SESSION['name'] = $val['name'];
    // $_SESSION['kanri_flg'] = $val['kanri_flg'];
    header('Location: user.php');
} else {
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();

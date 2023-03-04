<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Document</title>
</head>
    
<body>
<h1>会員登録</h1>
    <div class="form">
    <form action="r-insert.php" method="post" >
        <div class="uiForm">
            <div class="formField">
            <label for="">メールアドレス</label>
            <input type="email" name="rmail" id="">
            </div>
            <div class="formField">
            <label for="">パスワード</label>
            <input type="password" name="rps" id="">
            </div>
            <div class="formField">
            <label for="">お名前</label>
            <input type="text" name="rname" id="">
            </div>
            
            <input type="submit" value="登録する" class="rbtn">
           
        </div>
    </form>
    </div>
    
</body>
</html>
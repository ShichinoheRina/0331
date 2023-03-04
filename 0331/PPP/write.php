<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/write.css" rel="stylesheet">

</head>
<body>
<div>
<input form="w-form" type="submit" value="投稿する" class="sbtn">
</div>

<div></div>
<div>
    <form  id="w-form" action="insert.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
            <div class="jumbotron">
                <p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="500" height="100"></p>
                <label><input type="file" name="fname" class="cms-item" accept="image/*"></label><br>
                <label><input type="text" name="title" class="titile" placeholder="記事タイトル"></label><br>
                <label><textarea name="content" rows="7" cols="60" class="content"></textarea></label><br>
            </div>
    </form>
</div>

<div></div>
</body>

<footer>
<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
<script>
//---------------------------------------------------
//画像サムネイル表示
//---------------------------------------------------
// アップロードするファイルを選択
$('input[type=file]').change(function() {
  //選択したファイルを取得し、file変数に格納
  var file = $(this).prop('files')[0];
  // 画像以外は処理を停止
  if (!file.type.match('image.*')) {
    // クリア
    $(this).val(''); //選択されてるファイルを空にする
    $('.cms-thumb > img').html(''); //画像表示箇所を空にする
    return;
  }
  // 画像表示
  var reader = new FileReader(); //1
  reader.onload = function() {   //2
    $('.cms-thumb > img').attr('src', reader.result);
  }
  reader.readAsDataURL(file);    //3
});
</script>
</footer>
</html>

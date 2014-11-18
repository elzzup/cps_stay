<?php
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>残留申請CSV作成</h1>
    <form action="out.php" method="GET">
    学籍番号<input id="univ_id" type="text" name="univ_id">
    <br />
    ユーザーID(hiro)<input id="user_id" type="text" name="user_id">
    <br />
    <input id="y" type="text" name="y">年
    <input id="m" type="text" name="m">月
    <br />
    <input type="submit" value="作成">
</form>
    
</body>
</html>

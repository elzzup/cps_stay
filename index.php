<?php
$err = isset($_GET['e']);
$year = date('Y');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>CPS LAB残留申請CSV作成</h1>
    <form action="out.php" method="GET">
    学籍番号<input id="univ_id" type="text" name="univ_id">
    <br />
    ユーザー名(etc: hiro)<input id="user_id" type="text" name="user_id">
    <br />
    <select id="y" name="y">
        <?php foreach (range($year, $year + 5) as $y) { ?>
        <option value="<?= $y ?>"><?= $y ?></option>
        <?php } ?>
    </select>年

    <br />
    <input type="submit" value="作成">
    <?php if ($err) { ?>
        <p>エラー</p>
    <?php } ?>

</form>

</body>
</html>

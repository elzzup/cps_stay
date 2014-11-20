<?php
$err = isset($_GET['e']);
$year = date('Y');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>CPS LAB残留申請CSV作成</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
<link rel="stylesheet" href="./style/style.css">
<script>
window.onload = function() {
    document.getElementById('submit-button').addEventListener("mouseover", function() {
        document.getElementById("err-box").removeChild(document.getElementById("err"));
    });
}
</script>
</head>
<body>
    <header>
        <h1>CPS LAB残留申請CSV作成</h1>
    </header>
    <section class="wrap">
        <h2>残留申請生成フォーム</h2>
        <div class="card">
            <form action="out.php" method="GET">
                <section class="form-item">
                    <h4 class="key">ID</h4>
                    <input id="univ_id" type="text" name="univ_id">
                    <div class="description shift-20">学籍番号 ex) 12fi091</div>
                </section>

                <section class="form-item">
                    <h4 class="key">Name</h4>
                    <input id="user_id" type="text" name="user_id">
                    <div class="description shift-20">userId ex) hiro</div>
                </section>

                <section class="form-item">
                    <h4 class="key">Year</h4>
                    <select id="y" name="y">
                        <?php foreach (range($year, $year + 5) as $y) { ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                        <?php } ?>
                    </select>年
                    <div class="description shift-20">年 ex) 2014</div>
                </section>


                <div class="shift-20">
                    <input id="submit-button" type="submit" value="作成">
                </div>

                <?php if ($err) { ?>
                <div id="err-box">
                    <p id="err">エラー</p>
                </div>
                <?php } ?>
            </form>
            <section class="note">
                <h4>※解説・注意</h4>
                <ul>
                    <li>
                        構成はcsvファイルx12のzipがダウンロードできます<br />
                        一つのファイルが一月分で、その月の全ての日について申請が記述されています
                    </li>
                    <li>
                        残留申請は提出日より前の日が含まれる場合通りません<br />
                        そのため予め省かれて生成されます
                    </li>
                </ul>
            </section>
        </div>
    <section>
<footer>
    <a href="//elzup.com">elzup.com</a>
</footer>

</body>
</html>

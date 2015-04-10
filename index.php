<?php
$err = isset($_GET['e']);
$ny = date('Y');
$nm = date('n');
ini_set('display_errors', '1');
error_reporting(E_ALL);

$room = array(
);
require_once('./functions.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CPS LAB残留申請CSV作成</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="./style/style.css">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<header>
    <div class="row">
        <div class="large-12 columns">
            <h1>CPS LAB残留申請CSV作成請</h1>
        </div>
    </div>
</header>

<form action="out.php">
  <div class="row">
    <div class="large-4 columns">
      <label>ID
        <input type="text" placeholder="12fi091" />
      </label>
    </div>
    <div class="large-4 columns">
      <label>Name
        <input type="text" placeholder="hiro" />
      </label>
    </div>
    <div class="large-4 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Year</label>
        <div class="small-9 columns">
            <select id="y" name="y">
                <?php foreach (range($ny, $ny + 5) as $y) { ?>
                <option value="<?= $y ?>"><?= $y ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="small-3 columns">
          <span class="postfix">年</span>
        </div>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Month</label>
        <div class="small-9 columns">
          <select id="m" name="m">
            <option value="0">All (zip)</option>
            <?php foreach (range(1, 12) as $m) { ?>
            <option value="<?= $m ?>" <?= $m == $nm ? 'selected' : '' ?>><?= $m ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="small-3 columns">
          <span class="postfix">月</span>
        </div>
      </div>
    </div>
    <div class="large-4 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <div id="month-field">
        <div class="row collapse">
          <div class="large-6 columns">
          </div>
        </div>
        <?php table_cal($ny, $nm) ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-4 large-offset-4 columns">
        <input id="submit-button" type="submit" class="button expanded" value="作成">
    </div>
  </div>
</form>

    <section class="wrap">
        <h2>残留申請生成フォーム</h2>
        <div class="card row">

            <form action="out.php" method="GET">
                <div class="large-12 columns">
                    <label>ID</label>
                    <input id="univ_id" type="text" name="univ_id">
                    <div class="description shift-20">学籍番号 ex) 12fi091</div>
                </div>

                <section class="form-item">
                    <h4 class="key">Name</h4>
                    <input id="user_id" type="text" name="user_id">
                    <div class="description shift-20">userId ex) hiro</div>
                </section>

                <section class="form-item">
                    <h4 class="key">ny</h4>
                    <select id="y" name="y">
                        <?php foreach (range($ny, $ny + 5) as $y) { ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                        <?php } ?>
                    </select>年
                    <div class="description shift-20">年 ex) 2014</div>
                </section>

                <section class="form-item">
                    <h4 class="key">OnMonth</h4>
                    <input id="month" type="text" name="month">
                    <div class="description shift-20"></div>
                </section>

                <div class="shift-20">
                    <input id="submit-button" type="submit" value="作成">
                </div>

                <?php if ($err) { ?>
                <div id="err-box">
                    <p id="err">エラー</p>
                </div>
                <?php } ?>
                </div>
            </form>
                </div>
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
            </section>
    <section>
<footer>
    <a href="//elzup.com">elzup.com</a>
</footer>

</body>
</html>

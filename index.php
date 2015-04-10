<?php
$err = isset($_GET['e']);
$ny = date('Y');
$nm = date('n');
ini_set('display_errors', '1');
error_reporting(E_ALL);

$room_codes = array(
    '岩井研11階' => '8011107B0',
    '岩井研14階' => '801140600',
    'その他' => '0'
);
$room_id_default = '8011107B0';
$teacher_codes = array(
    '岩井' => '1817',
    'その他' => '0'
);
$teacher_id_default = '1817';

require_once('./functions.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>残留申請CSV作成 東京電機大学</title>
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
            <h1>残留申請CSV作成 東京電機大学</h1>
        </div>
    </div>
</header>

<form action="out.php">
  <div class="row">
    <div class="large-4 columns">
        <label>ID
            <input id="univ_id" name="univ_id" type="text" placeholder="12fi091" />
        </label>
    </div>
    <div class="large-4 columns">
        <label>Name
            <input id="user_id" name="user_id" type="text" placeholder="hiro" />
        </label>
    </div>
    <div class="large-4 columns">
        <!-- TODO: チェックボックス -->
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
        <label>Teacher</label>
        <select id="teacher-tmp">
            <?php foreach ($teacher_codes as $name => $code) { ?>
            <option value="<?= $code ?>" <?= $code == $teacher_id_default ? 'selected' : '' ?>><?= $name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="large-4 columns">
      <label id="teacher-field">Other
      <input id="teacher_id" name="teacher_id" type="text" value="<?= $teacher_id_default ?>" placeholder="<?= $teacher_id_default ?>" />
      </label>
    </div>
    <div class="large-4 columns">
        <!-- TODO: 問い合わせ -->
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
        <label>Room</label>
        <select id="room-tmp">
            <?php foreach ($room_codes as $name => $code) { ?>
            <option value="<?= $code ?>" <?= $code == $room_id_default ? 'selected' : '' ?>><?= $name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="large-4 columns">
      <label id="room-field">Other
      <input id="room_id" name="room_id" type="text" value="<?= $room_id_default ?>" placeholder="<?= $room_id_default ?>" />
      </label>
    </div>
    <div class="large-4 columns">
        <!-- TODO: 問い合わせ -->
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
        <!-- TODO: 便利ボタン -->
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

<footer>
    <a href="//elzup.com">elzup.com</a>
</footer>

</body>
</html>

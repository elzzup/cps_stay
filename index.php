<?php
$err = isset($_GET['e']);
$ny = date('Y');
$nm = date('n');

$room_codes = array(
    '岩井研11階' => '8011107B0',
    '岩井研14階' => '801140600',
    '五十嵐研' => '804051600',
    'その他' => '0'
);
$teacher_codes = array(
    '岩井' => '1817',
    '五十嵐' => '1634',
    'その他' => '0'
);

$univ_id_default    = @$_COOKIE['univ_id'] ?: '';
$user_id_default    = @$_COOKIE['user_id'] ?: '';
$room_id_default    = @$_COOKIE['room_id'] ?: '8011107B0';
$teacher_id_default = @$_COOKIE['teacher_id'] ?: '1817';

require_once('./modules/functions.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>残留申請CSV作成 東京電機大学</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/foundation-icons.css" />
    <link rel="stylesheet" href="css/style.css">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<header>
    <div class="row">
        <div class="large-12 columns">
            <h1><i class="fi-ticket"></i>&nbsp;残留申請CSV作成 東京電機大学</h1>
        </div>
    </div>
</header>

<form id="main_form" action="out.php">
  <div class="row">
    <div class="large-4 columns">
        <label>ID
            <input id="univ_id" name="univ_id" type="text" value="<?= $univ_id_default ?>" placeholder="12fi091" />
        </label>
        <small class="error">入力されていません</small>
    </div>
    <div class="large-4 columns">
        <label>Name
            <input id="user_id" name="user_id" type="text" value="<?= $user_id_default ?>"placeholder="hiro" />
        </label>
    </div>
    <div class="large-4 columns">
        <!-- TODO: -->
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
        <label>Teacher</label>
        <select id="teacher-tmp">
            <?php foreach ($teacher_codes as $name => $code) { ?>
            <option value="<?= $code ?>" <?= ($code == $teacher_id_default || ($code == '0' && !in_array($teacher_id_default, $teacher_codes))) ? 'selected' : '' ?>><?= $name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="large-4 columns">
      <label id="teacher-field">Other
      <input id="teacher_id" name="teacher_id" type="text" value="<?= $teacher_id_default ?>" placeholder="<?= $teacher_id_default ?>" />
      </label>
    </div>
    <div class="large-4 columns">

    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
        <label>Room</label>
        <select id="room-tmp">
            <?php foreach ($room_codes as $name => $code) { ?>
            <option value="<?= $code ?>" <?= ($code == $room_id_default || ($code == '0' && !in_array($room_id_default, $room_codes))) ? 'selected' : '' ?>><?= $name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="large-4 columns">
      <label id="room-field">Other
      <input id="room_id" name="room_id" type="text" value="<?= $room_id_default ?>" placeholder="<?= $room_id_default ?>" />
      </label>
    </div>
    <div class="large-4 columns">
        <!-- TODO: -->
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
        <!-- TODO: -->
        <span class="label info">Quick:</span>
        <a id="quick-year-button" class="tiny button"><i class="fi-clock"></i>&nbsp;Year</a>
        <a id="quick-today-button" class="tiny button"><i class="fi-clock"></i>&nbsp;Today</a>
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      <div id="month-field">
        <div class="row collapse">
          <div class="large-6 columns">
          </div>
        </div>
        <?php table_cal($ny, $nm) ?>
      </div>
    </div>
    <div class="large-6 columns">
        <div class="controllers">
            <ul class="stack-for-small round secondary button-group">
                <li><a id="check-all-button" class="small button"><i class="fi-check"></i></a></li>
                <li><a id="uncheck-all-button" class="small button"><i class="fi-minus"></i></a></li>
            </ul>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
        <a id="submit-button" class="button expand">作成</a>
    </div>
    <div class="large-4 columns">
        <input id="is_cache" type="checkbox" value="1" name="is_cache"><label for="is_cache">ID,Name,Teacher,Roomをキャッシュする</label>
    </div>
    <div class="large-4 columns panel radius">
        <p>リスト追加依頼は 12fi091&#64;ms.dendai.ac.jp に連絡していただければ対応します</p>
        ※注意: <br />
        <p>残留申請は指導教員の許可なしには提出ができません。また、研究以外での宿泊は認められていません。</p>
    </div>
  </div>
</form>

<footer>
    <a href="//elzup.com">elzup.com</a>
</footer>

</body>
</html>

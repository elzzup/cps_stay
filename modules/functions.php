<?php

function table_cal($y, $m) { 
    list($ny, $nm, $nd) = explode(',', date('Y,m,d'));
?>
<table>
    <caption><?= "{$y}年 {$m}月" ?></caption>
    <thead>
<?php foreach (explode(',', '日,月,火,水,木,金,土') as $i => $c) { ?>
        <th align='center'><a data-toggle-day="<?= $i ?>"><?= $c ?></a></th>
<?php } ?>
    </thead>
    <tbody>
<?php foreach (get_days($y, $m) as $days) { ?>
        <tr>
<?php
    foreach($days as $d) { 
        $checked = ($ny < $y) || ($ny == $y && $nm < $m) || ($ny == $y && $nm == $m && $nd <= $d) ? 'checked' : '';
?>
            <td>
<?php if (!empty($d)) { ?>
                <?= $d ?>
                <div class="switch tiny day">
                    <input id="d<?= $d ?>" type="checkbox" value="<?= $d ?>" name="day[]" <?= $checked ?>>
                    <label for="d<?= $d ?>"></label>
                </div> 
<?php } ?>
            </td>
<?php } ?>
        </tr>
<?php } ?>
    <tbody>
</table>
<?php
}


function get_days($y, $m) {
    list($w, $last) = explode(',', date('w,t',strtotime(date("{$y}/{$m}/1"))));
    $days = array_merge(($w == 0 ? array() : array_fill(0, $w, 0)), range(1, $last));
    return array_chunk($days, 7);
}

//generate_csv('12fi091', 'hiro', '2014', '12');
function generate_csv($univ_id, $user_id, $year, $month, $room, $building, $teacher, $days = array()) {
    $start = 1;
    $header = "No,残留日,残留者ユーザID,場所コード,建物コード,理由,その他,申請日,申請者ユーザID,Ｒ更新者,Ｒ更新日付,Ｒ更新時刻\n";
    mb_convert_variables('SJIS-win', 'UTF-8', $header);
    if (empty($days)) {
        if ($year == date('Y') && date('m') == $month) {
            $start = date('d');
        }
        $days = range($start, date('t', strtotime("{$year}/{$month}/1")));
    }
    $data = array();
    foreach ($days as $d) {
        $date = "{$year}/{$month}/{$d}";
        $data[] = implode(',', array('', $date, $univ_id, $room, $building, '1', $user_id, '', $teacher, '', '', ''));
    }
    $csv = implode("\n", $data);
    return $header . $csv;
}

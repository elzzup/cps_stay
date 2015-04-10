<?php

function table_cal($y, $m) { 
    list($ny, $nm, $nd) = explode(',', date('Y,m,d'));
?>
<table>
    <caption><?= "{$y}年 {$m}月" ?></caption>
    <thead>
        <th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
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
    $days = array_merge(($w == 0 ? [] : array_fill(0, $w, 0)), range(1, $last));
    return array_chunk($days, 7);
}

<?php

//generate_csv('12fi091', 'hiro', '2014', '12');
function generate_csv($univ_id, $user_id, $year, $month, $room, $building, $teacher = '1817') {
    $start = 1;
    if ($year == date('Y') && date('m') == $month) {
        $start = date('d');
    }
    $header = "No,残留日,残留者ユーザID,場所コード,建物コード,理由,その他,申請日,申請者ユーザID,Ｒ更新者,Ｒ更新日付,Ｒ更新時刻\n";
    mb_convert_variables('SJIS-win', 'UTF-8', $header);
    $datas = array();
    if ($month) {
        $data = array();
        for ($i = $start; $i <= num_month($year, $month); $i++) {
            $date = "{$year}/{$month}/{$i}";
            $data[] = implode(',', array('', $date, $univ_id, $room, $building, '1', $user_id, '', $teacher, '', '', ''));
        }
        $csv = implode("\n", $data);
    }
    return $header . $csv;
}

function num_month($y, $m) {
    if ($m == 2) {
        return is_uru($y) ? 29 : 28;
    }
    return (($m & 1) xor ($m >> 3)) ? 31 : 30;
}

function is_uru($y) {
    return ($y % 400 == 0) || (!($y % 100 == 0) && ($y % 4 == 0));
}

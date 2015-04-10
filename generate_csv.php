<?php

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

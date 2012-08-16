<?php

class VDate extends CComponent {

    public function getDay($day = null) {
        if (!isset($day))
            $day = date("w");

        switch ($day) {
            case 0: $day = "Minggu";
                break;
            case 1: $day = "Senin";
                break;
            case 2: $day = "Selasa";
                break;
            case 3: $day = "Rabu";
                break;
            case 4: $day = "Kamis";
                break;
            case 5: $day = "Jum'at";
                break;
            case 6: $day = "Sabtu";
                break;
        }
        return $day;
    }

    public function getDayOptions() {
        $daysArray = array(
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => "Jum'at",
            '6' => 'Sabtu',
            '7' => 'Minggu',
        );
        return $daysArray;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transformation extends Controller
{
       /*
        perkiraan formatting jam pulsa habis
        untuk format jam -> hari, jam -> minggu, jam -> bulan
    */

    public static function perkiraan_pulsa_habis_convert($per_hari_format){

        $format_dictionary = array(
            'hari'=>1,
            'minggu'=>7,
        );

        $final_perkiraan = 0;
        $perkiraan_pulsa_habis= '';

        $description_pulsa_show_hidden = '';

        if($per_hari_format >= $format_dictionary['hari'] && $per_hari_format < $format_dictionary['minggu']){
            
            $final_perkiraan = (string) $per_hari_format / $format_dictionary['hari'];
            $spliting = explode(".",$final_perkiraan);
            $description_pulsa_show_hidden = "Electricity will be running out soon!";
            $hari   = (int) $spliting[0];


            $to_jam = "0." . $spliting[1];
            $to_jam = (float) $to_jam;
            $to_jam = $to_jam * 24;

            $jam = explode(".",$to_jam);
            $jam = (int) $jam[0];

            if($jam == 0){
                $perkiraan_pulsa_habis = $hari . " Day";
            }else{
                $perkiraan_pulsa_habis = $hari . " Day " . $jam . " Hour";
            }
        }else if($per_hari_format >= $format_dictionary['minggu']){

            $final_perkiraan = (string) $per_hari_format / $format_dictionary['minggu'];

            $spliting_hari= explode(".", $final_perkiraan);
            $description_pulsa_show_hidden = "Electricity still a lot";

            $minggu   = (int) $spliting_hari[0];

            $to_hari = "0." . $spliting_hari[1];
            $to_hari = (float) $to_hari;

            $to_hari = $to_hari * 7;
            $hari = explode(".",$to_hari);
            $hari = (int) $hari[0];

            if($hari == 0){
                $perkiraan_pulsa_habis = $minggu . " Week";
            }else{

                $perkiraan_pulsa_habis = $minggu . " Week " . $hari . " Day";
            }

        }else if($per_hari_format < 1){

            $description_pulsa_show_hidden = "Data electricity will run out in is empty !";

            $final_perkiraan = (string) $per_hari_format * 24;

            $spliting_jam = explode(".", $final_perkiraan);

            $jam = (int) $spliting_jam[0];

            if($jam == 0){
                $perkiraan_pulsa_habis = "-";

            }else{
                $perkiraan_pulsa_habis = $jam . " Hour";
            }

        }

        return [$perkiraan_pulsa_habis, $description_pulsa_show_hidden];

    }

  public static function ToDataGrafik($values){

        //initial aactual
        $values_tanggal = [];
        $values_data = [];


        //actual
        foreach($values as $y){
            $str = explode(" ",$y->tanggal);
            $tanggal = explode("-", $str[0]);
            $jam = explode(":", $str[1]);
            $values_tanggal[] = mktime($jam[0], $jam[1], $jam[2], $tanggal[1], $tanggal[2], $tanggal[0]) * 1000;
        }

        //actual
        foreach ($values as $x) {
            $values_data[] = (float) $x->pemakaian_listrik;
        }

        $final_actual = [];

        //actual
        for($i=0; $i< count($values); $i++){

            $final_actual[] = [$values_tanggal[$i], $values_data[$i]];
        }

        $final_actual = array(json_encode($final_actual));

        return $final_actual;

    }


}

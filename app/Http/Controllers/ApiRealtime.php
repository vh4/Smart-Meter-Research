<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Actual;
use App\Models\Datalistrik;
use App\Http\Controllers\Transformation;
use App\Models\Lstm;
use App\Models\Token;
use Carbon\Carbon;

//use Carbon\Carbon;
//use Illuminate\Support\Facades\DB;


class ApiRealtime extends Controller
{
    public function index($nomorserial_id){

        #$datetime = new Carbon('2022-03-16 21:03:25');
        #$datetime = Carbon::today();

        //$datetime = $datetime->subHours(1);
        //$total_7hari = DB::table('actuals')->where('tanggal', '>=', $datetime->subDays(7))->orderByDesc('tanggal')->get()->take(168);

        //untuk menghindari null value, maka tanggal tidak perlu dipakai, hanya dengan mengambil 168 data pada waktu terakhir saja.
        //batas maksimal rata-rata 7 hari atau 168 data.


        //nilai rata-rata tidak akan null jika pembacaan seven segment tidak berjalan, karena akan menggunakan rata-rata sebelumnya. (untuk Sementara sampai seven segmen berjalan kembali)

        $total_7hari = Actual::where('nomorserial_id', $nomorserial_id)->orderBy('tanggal', 'DESC')->get()->take(168);
        $rata_rata = null;


        if(count($total_7hari) >= 168){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 7;

        }else if(count($total_7hari) > 24 && count($total_7hari) <= 48){ // range 2 hari (dibagi rata-rata 2)

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 2;

        }else if(count($total_7hari) > 48 && count($total_7hari) <= 72){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 3; // range 3 hari (dibagi rata-rata 3)

        }else if(count($total_7hari) > 72 && count($total_7hari) <= 96){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 4; // range 4 hari (dibagi rata-rata 4)

        }else if(count($total_7hari) > 96 && count($total_7hari) <= 120){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 5; // range 5 hari (dibagi rata-rata 5)

        }else if(count($total_7hari) > 120 && count($total_7hari) <= 144){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 6; // range 6 hari (dibagi rata-rata 6)

        }else if(count($total_7hari) > 144 && count($total_7hari) <= 168){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 7; // range 6 hari (dibagi rata-rata 6)
        }
        else if(count($total_7hari) <= 24){

            $rata_rata = $total_7hari->sum('pemakaian_listrik') / 1; // range 1 hari (dibagi rata-rata 1)

        }

        /*

            Panggil Data Listrik dimana user_id sama dengan pengguna yang login.
            data listrik akan ditampilkan di dashboard user

        */

        $data_listrik = Datalistrik::where('nomorserial_id', $nomorserial_id)->first();

        /*

            token realtime untuk trigger notifikasi ke user bahwa token sedang proses atau sudah selesai

        */

        $tokens = Token::where('nomorserial_id', $nomorserial_id)->first();

        /*

            Mengambil data 1hari kedepan

        */

        $satu_hari_kedepan = Lstm::where('nomorserial_id', $nomorserial_id)->orderBy('tanggal', 'ASC')->sum('pemakaian_listrik');

        /*
            Menghitung Sisa pulsa listrik akan habis dalam waktu berapa jam

        */
                #ambil pulsa listrik berdasarkan ID
                $sisa_pulsa = 0;
                $per_hari_format = 0;
                if($data_listrik !== null){
                    if($data_listrik->sisa_pulsa !== null && $satu_hari_kedepan !== 0){
                        $sisa_pulsa = $data_listrik->sisa_pulsa;
                        $per_hari_format = $sisa_pulsa/$satu_hari_kedepan;
                    }
                }

        /*

            transformasi perkiraan pulsa habis

        */

         //prediksi data
        $transformation_data =  Transformation::perkiraan_pulsa_habis_convert($per_hari_format);
        $perkiraan_pulsa_habis = $transformation_data[0];
        $notif_pulsa_day_habis_minggu_hidden = $transformation_data[1];


        //jumlah pemakaian hari ini.
        $pemakaian_hari_ini = Actual::where('nomorserial_id', $nomorserial_id)->whereDate('tanggal', date('Y-m-d'))->get();
        $pemakaian_hari_ini = (count($pemakaian_hari_ini) > 0) ? $pemakaian_hari_ini->sum('pemakaian_listrik') : 0;

        //make create mengambil data penggunaan listrik hari sebelumnya
        $pemakaian_hari_sebelumnya = Actual::where('nomorserial_id', $nomorserial_id)->whereDate('tanggal', date('Y-m-d', strtotime('-1 day')))->get();
        $pemakaian_hari_sebelumnya = (count($pemakaian_hari_sebelumnya) > 0) ? $pemakaian_hari_sebelumnya->sum('pemakaian_listrik') : 0;


        //update waktu terakhir data sisa pulsa listrik

        $waktu_terakhir_update_sisa_pulsa = Datalistrik::where('nomorserial_id', $nomorserial_id)->first();


        return response()->json([

            'data_listrik' => $data_listrik,
            'perkiraan_pulsa_habis' => $perkiraan_pulsa_habis,
            'prediksi_satu_hari_kedepan' => number_format((float)$satu_hari_kedepan, 2, '.', ''),
            'data_token' => $tokens,
            'rata_rata' => number_format($rata_rata, 2, '.', ''),
            'notif_electricity_will_run_out_in' => $notif_pulsa_day_habis_minggu_hidden,
            'pemakaian_hari_ini' => $pemakaian_hari_ini,
            'pemakaian_hari_sebelumnya' => $pemakaian_hari_sebelumnya,
            'waktu_terakhir_update_sisa_pulsa' => $waktu_terakhir_update_sisa_pulsa->tanggal,
        ]);

    }

    public function grafikRealtime($nomorserial_id, $jumlahdata){

        /*

            Mengambil semua data Actual untuk Grafik dan mengambil jumlah data LSTM untuk check apakah data prediksi sudah ada ? kalau
            belum, maka tidak akan ditampilkan

        */

                $actual = Actual::where('nomorserial_id', $nomorserial_id)->orderBy('tanggal', 'DESC')->get()->take($jumlahdata);


                //prediksi data
                $prediksi = Lstm::where('nomorserial_id', $nomorserial_id)->orderBy('tanggal', 'DESC')->get();

        /*

           transformation data grafik actual dan prediksi

       */

               $data_grafik_actual = Transformation::ToDataGrafik($actual);
               $data_grafik_prediksi = Transformation::ToDataGrafik($prediksi);

               return response()->json([
                   'data_actual' => $data_grafik_actual,
                   'data_prediksi' => $data_grafik_prediksi,
               ]);
    }
}

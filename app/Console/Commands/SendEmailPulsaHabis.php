<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\Actual;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Email;

class SendEmailPulsaHabis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "mail:emailpulsahabis";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "untuk notif ketika pulsa hampir habis";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set("Asia/Jakarta");
        $today = date("Y-m-d H:i:s");
        $today = date("Y-m-d H:i:s", strtotime($today));

        $user = User::all();

        foreach ($user as $x) {
            
            if ($x->rules == "user") {
                /**
                
                1. 21-05-2022 => pulsa habis sisa 0.1, lalu dikirim ke email
                2. selanjutnya,  tanggal 21-05-2022 akan di update ke email kolom tanggal

                lalu hari sudah berlalu,
                menjadi hari ini => 22-05-2022

                check:

                a. jika 21-05-2022 < (22-05-2022 - 1) => hasil 21-05-2022 < 21-05-2022
                tidak dijalankan, karena masih belum <

                lalu hari sudah berlalu lagi,
                menjadi hari ini => 23-05-2022

                b. jika 21-05-2022 < (23-05-2022 - 1) => hasil 21-05-2022 < 22-05-2022
                dijalankan, karena masih tanggal 21 < 23 (True)
                 **/
                
                if (
                    $x->nomorserial->datalistrik->sisa_pulsa !== null &&
                    $x->nomorserial->datalistrik->sisa_pulsa < 1 &&
                    $x->nomorserial->email->tanggal < Carbon::now()->subDay() 
                ) {
                    Email::where(
                        "nomorserial_id",
                        $x->nomorserial->nomorserial_id
                    )->update([
                        "subject" => "penting!, notif untuk sisa pulsa listrik",
                        "tanggal" => Carbon::now(),
                    ]);

                    $pulsa_habis = $x->nomorserial->datalistrik->sisa_pulsa;
                    $nama = $x->username;
                    $email = $x->email;

                    $penggunaan_hari_ini = Actual::where("tanggal", "<", $today)
                        ->where(
                            "nomorserial_id",
                            $x->nomorserial->nomorserial_id
                        )
                        ->orderBy("tanggal", "DESC")
                        ->get();
                    $tampung_penggunaan_hari_ini = [];

                    foreach ($penggunaan_hari_ini as $x) {
                        $tampung_penggunaan_hari_ini[] = $x->pemakaian_listrik;
                    }

                    $penggunaan_1_hari = array_sum(
                        array_slice($tampung_penggunaan_hari_ini, 0, 24)
                    );

                    Mail::to($email)->send(
                        new \App\Mail\SendEmailPulsaHabis(
                            $nama,
                            $pulsa_habis,
                            $penggunaan_1_hari
                        )
                    );
                    print "mail terkirim!";
                }
            }
        }
        return 0;
    }
}

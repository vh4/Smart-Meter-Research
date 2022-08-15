<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\KirimEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Actual;


class EmailPenggunaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untuk notifikasi email pengguna listrik';

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
        
        foreach($user as $x){
            if($x->rules == 'user'){
                if($x->nomorserial->datalistrik->sisa_pulsa !== null){
                        
                        $pulsa_habis = $x->nomorserial->datalistrik->sisa_pulsa;
                        $nama = $x->username;
                        $email = $x->email;
                        
                        $penggunaan_hari_ini = Actual::where('tanggal', '<', $today)->where('nomorserial_id', $x->nomorserial->nomorserial_id)->orderBy('tanggal', 'DESC')->get();
                        $tampung_penggunaan_hari_ini = [];
                    
                        foreach($penggunaan_hari_ini  as $x){
                            $tampung_penggunaan_hari_ini[] = $x->pemakaian_listrik;
                        }
                    
                        $penggunaan_1_hari = array_sum(array_slice($tampung_penggunaan_hari_ini, 0, 24));
                
                        Mail::to($email)->send(new KirimEmail($nama, $pulsa_habis, $penggunaan_1_hari));
                }
            }
        }
        return 0;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $nama;
    protected $sisa_pulsa;
    protected $penggunaan_1hari;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $sisa_pulsa, $penggunaan_1hari)
    {
        $this->nama = $nama;
        $this->sisa_pulsa = $sisa_pulsa;
        $this->penggunaan_1hari = $penggunaan_1hari;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        print('sedang mengirim email...');
        return $this->subject('U-Elektrik Notifikasi, Jangan Lupa Check Penggunaan Kamu Sekarang Ini !')
        ->view('email.IngatEmail', [
            'nama' => $this->nama,
            'sisa_pulsa' => $this->sisa_pulsa,
            'penggunaan_1hari' => $this->penggunaan_1hari,

        ]);
    }
}

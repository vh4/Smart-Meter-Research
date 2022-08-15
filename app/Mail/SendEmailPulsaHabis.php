<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPulsaHabis extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama,  $sisa_pulsa, $penggunaan_1hari)
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
        echo 'Email Berhasil dikirim !' . '\n';
        return $this->subject('Penting! Jangan Lupa Cek Sisa Pulsa dan Penggunaan Kamu sekarang ini. U-Elektrik Website')
        ->view('email.pulsaHabis', [
            'nama' => $this->nama,
            'sisa_pulsa' => $this->sisa_pulsa,
            'penggunaan_1hari' => $this->penggunaan_1hari,
        ]);
    }
}

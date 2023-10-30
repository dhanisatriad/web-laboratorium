<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class laboratoriumEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->details);
        return $this->from('labteknikelektrouin@gmail.com')
            ->view('emailPesan')
            ->with([
                    'nama' => $this->details['nama'],
                    'nim' => $this->details['nim'],
                    'level' => $this->details['level'],

                ])
                ->attach(storage::path($this->details['suratIzin']) , [
                    'as' => 'surat_izin.pdf',
                    'mime' => 'application/pdf',
                  ]);
    }
}

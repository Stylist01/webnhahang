<?php

namespace App\Mail;

use App\Model\Personnel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $personnel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Personnel $personnel)
    {
        $this->personnel = $personnel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(env('MAIL_USERNAME', 'laravel@gmail.com'))
            ->subject('Thông báo từ quản lý của nhà hàng Mỳ cay Lizardon')
            ->view('admin.email.index')
            ->with('personnel', $this->personnel);
    }
}

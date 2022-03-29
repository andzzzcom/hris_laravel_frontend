<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $data;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
		$this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$link = $this->data["link"];
		return 
			$this
			->from("psikoappui2021@gmail.com")
			->subject('Reset Password Link')
			->view('Admin.email.reset')
			->with([
				"link"=>$link
			]);
		
    }
}

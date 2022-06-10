<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use Illuminate\Contracts\Mail\Mailer;

class SendResetPasswordLinkToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = [];
    protected $siteSettings;
    protected $rememberToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $rememberToken, $siteSettings)
    {
        $this->data         = $data;
        $this->siteSettings = $siteSettings;
        $this->rememberToken= $rememberToken;    
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.site.reset_password_link_to_user', ['userDetails' => $this->data, 'rememberToken' => $this->rememberToken, 'siteSettings' => $this->siteSettings], function ($message) {
            $message->from($this->siteSettings['from_email'], $this->siteSettings['website_title']);
            $message->to($this->data['email'], $this->siteSettings['website_title'])->subject(trans('custom.label_reset_password_link'));
        });
    }
}

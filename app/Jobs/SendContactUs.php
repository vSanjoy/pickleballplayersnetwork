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

class SendContactUs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = [];
    protected $siteSettings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $siteSettings)
    {
        $this->data         = $data;
        $this->siteSettings = $siteSettings;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.site.contact_details_to_admin', ['contactDetails' => $this->data, 'siteSettings' => $this->siteSettings], function ($message) {
            $message->from($this->siteSettings['from_email'], $this->siteSettings['website_title']);
            $message->to($this->siteSettings['to_email'], $this->siteSettings['website_title'])->subject(trans('custom.label_contact_form'));
        });
    }
}

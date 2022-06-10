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

class SendPickleballCourtRegistrationToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = [];
    protected $stateName;
    protected $siteSettings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $stateName, $siteSettings)
    {
        $this->data         = $data;
        $this->stateName    = $stateName;
        $this->siteSettings = $siteSettings;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.site.pickleball_court_registration_details_to_admin', ['newPickleballCourt' => $this->data, 'stateName' => $this->stateName, 'siteSettings' => $this->siteSettings], function ($message) {
            $message->from($this->siteSettings['from_email'], $this->siteSettings['website_title']);
            $message->to($this->siteSettings['to_email'], $this->siteSettings['website_title'])->subject(trans('custom.label_email_pickleball_court_registration'));
        });
    }
}

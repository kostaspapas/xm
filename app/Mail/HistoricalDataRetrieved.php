<?php

namespace App\Mail;

use App\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HistoricalDataRetrieved extends Mailable
{
    use Queueable, SerializesModels;

    private $companySymbol;
    private $startDate;
    private $endDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $companySymbol, string $startDate, string $endDate)
    {
        $this->companySymbol = $companySymbol;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = new Company();

        $subject = $company->getCompanyName($this->companySymbol);
        $body = [
            'body' => "From {$this->startDate} to {$this->endDate}"
        ];

        return $this->from('kostas@example.com')
            ->subject($subject)
            ->view('email', $body);
    }
}

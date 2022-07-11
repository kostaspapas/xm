<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\HistoricalQuotesRequest;
use App\Mail\HistoricalDataRetrieved;
use App\Services\financeRapidApiService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    private $financeRapidApiService;

    public function __construct(FinanceRapidApiService $financeRapidApiService)
    {
        $this->financeRapidApiService = $financeRapidApiService;
    }

    public function index()
    {
        $company = new Company();
        $companySymbols = $company->getSymbols();

        return view('form', ['company_symbols' => $companySymbols]);
    }

    /**
     * @param HistoricalQuotesRequest $request The class about the request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post(HistoricalQuotesRequest $request) {
        $companySymbol = $request->get('company_symbol');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $email = $request->get('email');

        $data = $this->financeRapidApiService->getHistoricalData(
            $companySymbol,
            $startDate,
            $endDate
        );

        $historicalDataRetrieved = new HistoricalDataRetrieved(
            $companySymbol,
            $startDate,
            $endDate
        );
        Mail::to($email)->send($historicalDataRetrieved);

        return view('results', $data);
    }
}

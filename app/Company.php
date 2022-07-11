<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Company
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'financial_status',
        'market_category',
        'round_lot_size',
        'security_name',
        'symbol',
        'test_issue'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function getCompanyName(string $symbol): string
    {
         return DB::table('companies')->where('symbol', $symbol)->value('company_name');
    }

    public function getSymbols(): array
    {
        return DB::select('SELECT symbol FROM companies ORDER BY symbol ASC');
    }

    public function getFormattedSymbols(): array
    {
        $companySymbols = $this->getSymbols();

        $formattedCompanySymbols = [];

        foreach ($companySymbols as $object) {
            $formattedCompanySymbols[] = $object->symbol;
        }

        return $formattedCompanySymbols;
    }
}

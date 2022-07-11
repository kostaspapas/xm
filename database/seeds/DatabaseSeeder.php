<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $file = "data.json";

        $companyData = file_get_contents($file);

        if ($companyData === false) {
            throw Exception('Something wrong when trying to get the content of file data.json');
        }

        $companyDataObject = json_decode($companyData,true, 512);

        foreach ($companyDataObject as $company) {
            DB::table('companies')->insert([
                'company_name' => $company['Company Name'],
                'financial_status' => $company['Financial Status'],
                'market_category' => $company['Market Category'],
                'round_lot_size' => $company['Round Lot Size'],
                'security_name' => $company['Security Name'],
                'symbol' => $company['Symbol'],
                'test_issue' => $company['Test Issue']
            ]);
        }
    }
}

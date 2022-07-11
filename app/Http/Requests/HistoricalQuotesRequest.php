<?php

declare(strict_types=1);

namespace App\Http\Requests;

//use App\Traits\ApiResponser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Company;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class HistoricalQuotesRequest extends FormRequest
{
//    use ApiResponser;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $company = new Company();
        $companySymbols = $company->getFormattedSymbols();

        return [
            'company_symbol' => [
                'required',
                Rule::in($companySymbols),
            ],
            'start_date' => [
                'required',
                'date_format:m/d/Y',
                'before_or_equal:end_date',
                'before_or_equal:today'
             ],
            'end_date' => [
                'required',
                'date_format:m/d/Y',
                'after_or_equal:start_date',
                'before_or_equal:today'
            ],
            'email' => 'required | email'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(), 400));
    }

    public function messages()
    {
        return [
            'company_symbol.in' => ":attribute must be one of these values: [':values']",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'sector_id'=>'required',
            'trade_license'=>'required|string',
            'registry_office'=>'required|string',
            "trade_license_number"=>'required|numeric',
            "directorate"=>'required|string',
            "director_name"=>'string',
            "phone_number"=>'unique:suppliers,phone_number|string',
            "email"=>'email|unique:suppliers,email',
            "sales_manager_name"=>'string',
            "sales_manager_phone"=>'string',
            "company_number"=>'string',
            "fax_number"=>'numeric',
            "headquarters_address"=>'string',
            "company_email"=>'email',
            "manufacturing_license"=>'string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
    //  protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ], 422));
    // }
}

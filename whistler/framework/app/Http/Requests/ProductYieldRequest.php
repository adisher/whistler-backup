<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ProductYieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->user_type == "S" || Auth::user()->user_type == "O") {
            return true;
        } else {
            abort(404);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'site_name' => 'required|unique:product_yields,site_name,' . \Request::get("id") . ',id,deleted_at,NULL',
            'date' => 'required',
            'time' => 'required',
            'site_details' => 'required',
            'wastage' => 'required',
            'daily_quantity' => 'integer',
            'shift_yield' => 'required',
            'shift_yield_details' => 'required',
            'shift_incharge_id' => 'required',
            'shift_details' => 'required',
            'shift_quantity' => 'required',
            'yield_quality' => 'required',
            'daily_yield' => 'required',
            'yield_images' => 'nullable',
            'site_production_details' => 'required',
            'stock_details' => 'required',
        ];
    }
}
<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class VehicleModelRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'vehiclemodel' => 'required|unique:vehicle_model,name,' . \Request::get("id") . ',id,deleted_at,NULL',
            'icon' => 'nullable|mimes:jpg,png,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'vehiclemodel.unique' => 'Vehicle Model already exist',
        ];
    }
}

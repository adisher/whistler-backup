<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'yield_images.*' => ['required', function ($attribute, $value, $fail) {
                // Get the file extension
                $extension = $value->getClientOriginalExtension();
                $sizeInMB = $value->getSize() / 1024 / 1024; // convert file size from bytes to MB

                if (in_array($extension, ['jpeg', 'png']) && $sizeInMB > 2) {
                    $fail("Image files must not be greater than 2MB.");
                }

                if (in_array($extension, ['mp4', 'mkv']) && $sizeInMB > 10) {
                    $fail("Video files must not be greater than 10MB.");
                }

                if (!in_array($extension, ['jpeg', 'png', 'mp4', 'mkv'])) {
                    $fail("The file must be a file of type: jpeg, png, mp4, mkv.");
                }
            }],
        ];
    }

}

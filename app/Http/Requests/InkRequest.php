<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'user_slug' => 'required|exists:mysql.users,slug|String',
//            'ink_id' => 'required|exists:mysql.inks,id|Numeric',
            'text' => 'required_if:media,null|String|Nullable|min:1|max:255',
            'media' => 'required_if:text,null|Array|Nullable|max:64',
        ];
    }
}

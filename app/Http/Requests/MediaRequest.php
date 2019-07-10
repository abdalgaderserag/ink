<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
//            'ink_id' => 'required_if:comment_id,null|exists:mysql.inks,id|Numeric',
//            'comment_id' => 'required_if:ink_id,null|exists:mysql.comments,id|Numeric',
            'text' => 'String|Nullable|min:1|max:255',
            'media' => 'Array|Nullable|min:1|max:255',
        ];
    }
}

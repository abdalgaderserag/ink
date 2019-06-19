<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'ink_id' => 'required_if:comment_id,null|exists:mysql.inks,id|Numeric',
            'comment_id' => 'required_if:ink_id,null|exists:mysql.comments,id|Numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactFormRequest extends Request
{
    public function messages()
    {
        return [
            'in'                => 'Ce champs dois être du type: :values',
            'email'             => 'Ce champs dois être un email',
            'required'          => 'Ce champs est obligatoire',
            'max'               => 'Ce champs ne dois pas dépasser 255 caractere',
        ];
    }

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
        // htmlentities - email :
        $email = $this->all();
        $email['email'] = filter_var($email['email'], FILTER_SANITIZE_STRING);
        $this->replace($email);

        // htmlentities - content :
        $message = $this->all();
        $message['message'] = filter_var($message['message'], FILTER_SANITIZE_STRING);
        $this->replace($message);

        return [
            'email'         => 'required|email|max:255',
            'message'       => 'required',
        ];
    }
}

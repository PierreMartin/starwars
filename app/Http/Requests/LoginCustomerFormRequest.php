<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginCustomerFormRequest extends Request
{

    public function messages()
    {
        return [
            'in'                => 'Ce champs dois etre du type: :values',
            'required'          => 'Ce champs est obligatoire',
            'max'               => 'Ce champs ne dois pas dépasser 255 caractere',
            'email'             => 'Ce champs dois être un email',
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
        // htmlentities - customer_name :
        $customer_name = $this->all();
        $customer_name['customer_name'] = filter_var($customer_name['customer_name'], FILTER_SANITIZE_STRING);
        $this->replace($customer_name);

        // htmlentities - customer_email :
        $customer_email = $this->all();
        $customer_email['customer_email'] = filter_var($customer_email['customer_email'], FILTER_SANITIZE_STRING);
        $this->replace($customer_email);

        return [
            'customer_name'     => 'required|max:255',
            'customer_email'    => 'required|email|max:255',
        ];
    }
}

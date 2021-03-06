<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductFormRequest extends Request
{
    /**
     * @return array
     */
    public function messages()
    {
        return [
            'in'                => 'Ce champ doit être du type: :values',
            'required'          => 'Ce champ est obligatoire',
            'max'               => 'Ce champ ne doit pas dépasser 255 caractere',
            'size'              => 'Taille de l\'image trop grosse',
            'image'             => 'Seul les formats jpg, png, et gif sont autorisés',
            'date'              => 'Ce champ doit être une date (15-10-2015)',
            'between'           => 'Le prix doit être supérieur à :min et inférieur à :max €'
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
        // htmlentities - title :
        $title = $this->all();
        $title['title'] = filter_var($title['title'], FILTER_SANITIZE_STRING);
        $this->replace($title);

        // htmlentities - content :
        $content = $this->all();
        $content['content'] = filter_var($content['content'], FILTER_SANITIZE_STRING);
        $this->replace($content);

        // htmlentities - price :
        $price = $this->all();
        $price['price'] = filter_var($price['price'], FILTER_SANITIZE_STRING);
        $this->replace($price);

        // htmlentities - price :
        $date = $this->all();
        $date['published_at'] = filter_var($date['published_at'], FILTER_SANITIZE_STRING);
        $this->replace($date);

        return [
            'title'         => 'required|max:255',
            'content'       => 'required',
            'image'         => 'image',
            'category_id'   => 'required',
            'price'         => 'required|integer|between:0,100000',
            'published_at'  => 'date'
        ];
    }
}

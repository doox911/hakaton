<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     *  {
     *   searchers:[] - список поисковиков (youtube, yandex, google, wiki, etc.)
     *   search: string - поисковой запрос
     *   filters: [] - типы контента (video, image, article),
     * }
     *
     * @return array
     */
    public function rules(): array {
        return [
            'searchers' => 'required|array',
            'search' => 'required|string',
            'filters' => 'required|array'
        ];
    }
}

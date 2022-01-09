<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreThreadRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->getMethod() == 'PUT' && $this->request->has('best_answer_id')) {
            return [
                'best_answer_id' => 'required'
            ];
        } else {
            return [
                'title' => 'required',
                'content' => 'required',
                'channel_id' => 'required'
            ];
        }
    }
}

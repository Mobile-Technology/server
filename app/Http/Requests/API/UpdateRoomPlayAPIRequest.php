<?php

namespace App\Http\Requests\API;

use App\Models\RoomPlay;
use InfyOm\Generator\Request\APIRequest;

class UpdateRoomPlayAPIRequest extends APIRequest
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
        $rules = RoomPlay::$rules;
        
        return $rules;
    }
}

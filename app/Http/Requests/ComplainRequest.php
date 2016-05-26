<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComplainRequest extends Request
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
        /*
         * Method POST ialah validation bagi CREATE
         * Method PUT ialah validation bagi EDIT
         * */

        switch($this->method()) {
            case 'POST': {
                return ['complain_description' => 'required',];
            }
            case 'PUT': {
                return ['complain_description' => 'required',];
            }

            default:break;
        }

    }
}

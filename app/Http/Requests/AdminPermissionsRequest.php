<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminPermissionsRequest extends Request
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'display_name' => 'required|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $patch_rules = [
                            'name' => 'required|max:255',
                            'display_name' => 'required|max:255',

                ];

                return $patch_rules;
            }

            default:break;
        }

    }
}

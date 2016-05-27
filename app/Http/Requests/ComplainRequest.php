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

                $validaton_rules = array(
                                    'complain_category_id' => 'required',
                                    'complain_source_id' => 'required',
                                    'complain_description' => 'required',
                                    );

                //exclude Zakat2U and Zakat Portal from required validation

                $aduan_category_exception_value = array('5','6');

                $others_field_validation = array(
                                            'branch_id' => 'required',
                                            'lokasi_id' => 'required',
                                            'ict_no' => 'required'
                                            );

                //if complain_category_id not in category_exception_array, we put other validation

                if (!in_array($this->complain_category_id,$aduan_category_exception_value))
                {
                    $validaton_rules = $others_field_validation + $validaton_rules;
                }

                return $validaton_rules;
            }
            case 'PUT': {
                return ['complain_description' => 'required',];
            }

            default:break;
        }

    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Cawangan adalah wajib',
            'lokasi_id.required'  => 'Lokasi adalah wajib',
            'ict_no.required'  => 'Aset adalah wajib',
            'complain_category_id.required'  => 'Kategori adalah wajib',
            'complain_source_id.required'  => 'Kaedah adalah wajib',
            'complain_description.required'  => 'Aduan adalah wajib',
        ];
    }

}

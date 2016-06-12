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
        $route_name = $this->route()->getName();

        //dd($this->submit_type);

        //dd($route_name);

        /*
         * Method POST ialah validation bagi CREATE
         * Method PUT ialah validation bagi EDIT
         * */

        switch($this->method()) {
            case 'POST': {

                $validation_rules = array(
                                    'complain_category_id' => 'required',
                                    'complain_source_id' => 'required',
                                    'complain_description' => 'required',
                                    'complain_attachment' => 'mimes:jpeg,bmp,png,pdf,doc,docx,txt,zip,rar'
                                    );

                //exclude Zakat2U and Zakat Portal from required validation

                $aduan_category_exception_value = array('5','6');

                $others_field_validation = array(
                                            'branch_id' => 'required',
                                            'lokasi_id' => 'required',
                                            'ict_no' => 'required'
                                            );
                $complain_category_id_exp = explode('-', $this->complain_category_id);
                $complain_category_id = $complain_category_id_exp[0];

                //if complain_category_id not in category_exception_array, we put other validation

                if (!in_array($complain_category_id,$aduan_category_exception_value))
                {
                    $validation_rules = $others_field_validation + $validation_rules;
                }

                return $validation_rules;
            }
            case 'PUT': {

                $validation_rules = [];

                if ($route_name=='complain.update')
                {
//                    dd($this->exclude_category);

                    //kemaskini complain validation_rules

                    $validation_rules = array(
                        'complain_category_id' => 'required',
                        'branch_id' => 'required',
                        'lokasi_id' => 'required',
                        'ict_no' => 'required');

//                  //kalau TEKNIKAL EDIT FORM, tak perlu kategori id

                    if ($this->exclude_category=='Y')
                    {
                        array_pull($validation_rules, 'complain_category_id');
                    }

                    //kalau complain category id 5,6, tak perlu validate lokasi dan ict no

                    if ($this->exclude_branch_asset=='Y')
                    {
                        array_pull($validation_rules, 'complain_category_id');
                        array_pull($validation_rules, 'branch_id');
                        array_pull($validation_rules, 'lokasi_id');
                        array_pull($validation_rules, 'ict_no');
                    }

                }
                else if ($route_name=='complain.update_action')
                {
                    //kemaskini complain icthelpdesk ation validation_rules

                    if (!$this->has('submit_type')) {

                        $validation_rules = array(
                            'complain_status_id' => 'required',
                            'action_comment' => 'required',
                        );

                    }

                }
                else if ($route_name=='complain.verify')
                {
                    if ($this->submit_type=='reject')
                    {
                        $validation_rules = array(
                            'user_comment' => 'required',
                        );
                    }
                }

                return $validation_rules;
            }

            default:break;
        }

    }

    //customize validation message

    public function messages()
    {
        return [
            'branch_id.required' => 'Cawangan adalah wajib',
            'lokasi_id.required'  => 'Lokasi adalah wajib',
            'ict_no.required'  => 'Aset adalah wajib',
            'complain_category_id.required'  => 'Kategori adalah wajib',
            'complain_source_id.required'  => 'Kaedah adalah wajib',
            'complain_description.required'  => 'Aduan adalah wajib',
            'action_comment.required'  => 'Tindakan adalah wajib',
            'user_comment.required'  => 'Komen Pengguna adalah wajib jika status tidak selesai',
        ];
    }

}

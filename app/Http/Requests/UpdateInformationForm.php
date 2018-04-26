<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Person;
use App\Address;
use App\User;
use App\Role;
use Image;

class UpdateInformationForm extends FormRequest
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
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'middlename' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'datebirth' => 'required|date|max:255',
        ];
    }

    public function persist($id){
        
        $person = Person::where('user_id',$id)->first();

        $person->firstname = ucfirst( strtolower( $this->get('firstname') ) );
        $person->lastname = ucfirst( strtolower( $this->get('lastname') ) );
        $person->middlename = ucfirst( strtolower( $this->get('middlename') ) );
        $person->gender = ucfirst( strtolower( $this->get('gender') ) );
        $person->datebirth = ucfirst( strtolower( $this->get('datebirth') ) );
        $person->user_id = $id;
        $person->save();

    }


}

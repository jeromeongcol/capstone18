<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\User;
use Vinkla\Hashids\Facades\Hashids;
use Auth;

class UpdateAccountForm extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,'. Hashids::decode($this->get('id'))[0],
        ];
    }

    public function persist($id){

        $user = User::where('id',$id)->first();
        $user->email = $this->get('email');
        $user->role_id = $this->get('userrole');
        $user->active = $this->get('active');
        $user->added_by = Auth::User()->id;
        $user->update();

    }

}

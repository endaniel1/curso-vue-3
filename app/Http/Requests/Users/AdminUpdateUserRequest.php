<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(){
        return [
            'name.required' => 'Name required',
            'email.required' => 'Email required',
            'email.email' => 'Email invalid',
            'email.unique' => 'Email must be unique',
            'password.required' => 'Password required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
        ];
    }

    public function updateProfile(User $user) {
        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        $user->save();

        Bouncer::sync($user)->roles([]);
        $user->assign($this->role);
    }
}

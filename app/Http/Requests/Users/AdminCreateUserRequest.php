<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminCreateUserRequest extends FormRequest {
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
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
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
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email required',
            'email.email' => 'Email invalid',
            'email.unique' => 'Email must be unique',
            'password.required' => 'Password required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
        ];
    }
    public function createProfile(User $user) {
        $user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->save();
        $user->assign($this->role);
    }
}

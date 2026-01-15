<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')] 
#[Title('Masuk Aplikasi')]
class Login extends Component
{
    public $login_id = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'login_id' => 'required',
        'password' => 'required',
    ];

    public function authenticate()
    {
        $this->validate();

        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $this->login_id, 'password' => $this->password], $this->remember)) {
            request()->session()->regenerate();
            return redirect()->intended(route('client.dashboard'));
        }

        $this->addError('login_id', 'Email/Nomor HP atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    public $email = '';
    public $password = '';

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ];
    }

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                request()->session()->regenerate();
                
                // FIX: Menghapus 'navigate: true' untuk memaksa refresh halaman penuh.
                // Ini akan memastikan sesi login termuat dengan benar.
                return $this->redirect(route('admin.dashboard'));
            } else {
                Auth::logout();
                $this->addError('email', 'Anda tidak memiliki hak akses sebagai admin.');
            }
        } else {
            $this->addError('email', 'Email atau kata sandi yang Anda masukkan salah.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

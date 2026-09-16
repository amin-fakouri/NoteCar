<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyLogin extends Component
{
    public string $phone_number = '';

    public string $password = '';

    public bool $remember = false;

    #[Layout('components.my-login-cmpn')]
    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('ad_dash'); // یا هر روت داشبوردت
        }
    }

    public function render()
    {
        return view('livewire.my-login');
    }

    protected function rules(): array
    {
        return [
            'phone_number' => ['required', 'digits:11', 'regex:/^09[0-9]{9}$/'],
            'password' => ['required', 'string', 'min:8', 'max:12'],
        ];
    }

    protected array $messages = [
        'phone_number.required' => 'شماره موبایل را وارد کنید.',
        'password.required' => 'رمز عبور را وارد کنید.',
    ];

    public function login()
    {
        $this->validate();

        $key = 'login:'.$this->phone_number;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'phone_number' => "تعداد تلاش زیاد است. بعد از {$seconds} ثانیه دوباره تلاش کنید.",
            ]);
        }

        if (! Auth::attempt(
            ['phone_number' => $this->phone_number, 'password' => $this->password],
            $this->remember
        )) {
            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'all_alert' => 'شماره موبایل یا رمز عبور اشتباه است.',
            ]);
        }

        RateLimiter::clear($key);
        session()->regenerate();

        return redirect()->intended(route('ad_dash'));
    }
}

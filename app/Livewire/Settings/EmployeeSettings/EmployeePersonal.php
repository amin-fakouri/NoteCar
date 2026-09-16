<?php

namespace App\Livewire\Settings\EmployeeSettings;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EmployeePersonal extends Component
{
    public $phone_number;

    public $password = '';

    public $password_confirmation = '';

    #[Layout('components.settings.employee-settings.employee-personal')]
    public function mount()
    {
        $this->phone_number = auth()->user()->phone_number;
        // password رو mount نکن، همیشه خالی شروع بشه
    }

    public function render()
    {
        if (! Gate::allows('employeeRole', User::class)) {
            abort('404', 'صفحه مورد نظر یافت نشد!');
        }

        return view('livewire.settings.employee-settings.employee-personal');
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'phone_number' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user = auth()->user();
            $user->phone_number = $validated['phone_number'];

            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            $user->save();

            session()->flash('success', 'اطلاعات حساب با موفقیت به‌روزرسانی شد.');
        } catch (\Throwable $e) {
            session()->flash('error', 'خطایی در ذخیره اطلاعات رخ داد. لطفاً دوباره تلاش کنید.');
        }
    }
}

<?php

namespace App\Livewire\Manager;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CreateEmployee extends Component
{
    use WithPagination;
    public $phone_number;
    public $password;
    public $sortDirection = 'desc';

    public function mount()
    {
        abort_unless(auth()->user()->role_code == 1, 403);
    }

    #[Layout('components.manager.create-employee')]
    public function render()
    {
        if (! Gate::allows('managerRole', User::class)) {
            abort('404', 'صفحه مورد نظر یافت نشد!');
        }
            $users = User::select(['id', 'phone_number', 'role_code'])
                ->orderBy('id', $this->sortDirection)
                ->paginate(5);

            return view('livewire.manager.create-employee', [
                'users' => $users,
            ]);
    }

    public function create()
    {
        $validated = $this->validate([
            'phone_number' => ['required', 'digits:11', 'unique:users,phone_number'],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
            'role_code' => 2,
        ]);

        $this->reset(['phone_number', 'password']);
    }

    public function sort_table()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function delete_table($userId)
    {
        $user = User::findOrFail($userId);

        abort_if($user->role_code == 1, 403, 'مدیر قابل حذف نیست.');
        abort_if($user->id === auth()->id(), 403, 'نمی‌تونی حساب خودت رو حذف کنی.');

        $user->delete();
    }
}

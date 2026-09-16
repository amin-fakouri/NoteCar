<?php

namespace App\Livewire\Manager;

use App\Models\Specifications;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManagerPanel extends Component
{
    public $employees;

    public $cars;

    #[Layout('components.manager.manager-cmpn')]
    public function render()
    {

        if (! Gate::allows('managerRole', User::class)) {
            abort(404, 'صفحه مورد نظر یافت نشد!');
        }

        $this->employees = User::all();
        $this->cars = Specifications::all();

        return view('livewire.manager.manager-panel');
    }
}

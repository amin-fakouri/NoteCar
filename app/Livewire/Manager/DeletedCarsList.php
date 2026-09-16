<?php

namespace App\Livewire\Manager;

use App\Models\Specifications;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class DeletedCarsList extends Component
{

    use WithPagination;


    #[Layout('components.manager.deleted-cars-list')]
    public function render()
    {
        if (! Gate::allows('managerRole', User::class)) {
            abort('404', 'صفحه مورد نظر یافت نشد!');
        }
        $deletedCars = Specifications::onlyTrashed()
            ->with('deleter')
            ->latest('deleted_at')
            ->paginate(5);

        return view('livewire.manager.deleted-cars-list', [
            'deletedCars' => $deletedCars,
        ]);
    }


    public function restore($carId)
    {
        $car = Specifications::onlyTrashed()->findOrFail($carId);
        $car->restore();
        session()->flash('message', 'رکورد با موفقیت بازگردانی شد.');
    }

    public function forceDelete($carId)
    {
        $car = Specifications::onlyTrashed()->findOrFail($carId);
        $car->forceDelete();
        session()->flash('message', 'رکورد به‌طور کامل حذف شد.');
    }
}

<?php

namespace App\Livewire\Employee;

use App\Models\Specifications;
use Livewire\Attributes\Layout;
use Livewire\Component;

class FindCar extends Component
{
    public $find_n_car;

    #[Layout('components.employee.find-car')]
    public function mount($n_car_id)
    {
        $searchValue = trim($n_car_id);

        /*
         | فیلتر مستقیم توی دیتابیس (WHERE) انجام می‌شه، نه با پیمایش دستی کل
         | جدول توی PHP. این صفحه از باکس سرچ داشبورد میاد که روی car_name /
         | identification_number / plat_number کار می‌کنه:
         | - شماره شاستی و شماره پلاک: مطابقت دقیق (چون شناسه‌ی یکتا هستن)
         | - نام ماشین: مطابقت جزئی (LIKE)، چون معمولاً از dropdown روی یه
         |   ردیف کلیک شده و اسم کامل توی سرچ نشسته، ولی ممکنه دقیق نباشه
        */
        $specification = Specifications::query()
            ->where(function ($query) use ($searchValue) {
                $query->where('identification_number', $searchValue)
                    ->orWhere('plat_number', $searchValue)
                    ->orWhere('car_name', 'like', "%{$searchValue}%");
            })
            ->latest('id')
            ->first();

        abort_if(is_null($specification), 404, 'خودرویی با این مشخصات پیدا نشد.');

        $this->find_n_car = $specification;
    }

    public function render()
    {
        return view('livewire.employee.find-car');
    }
}

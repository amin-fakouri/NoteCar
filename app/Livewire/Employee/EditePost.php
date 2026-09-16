<?php

namespace App\Livewire\Employee;

use App\Models\Specifications;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditePost extends Component
{
    use WithFileUploads;

    public $find_id;

    public $update_data;

    public $specifications;

    public $identification_number;

    public $plat_number;

    public $model;

    public $color;

    public $car_name;

//    public $profit;
//
//    public $loss;

    public $gearbox_type;

    public $car_fuel_type;

    public $jdf;

    public $description;

    public $gear_type;

    public $promise_number;

    public $price_car;

    public $cylinder_type;

    // فیلدهای جدید: قبلاً توی migration و صفحه‌ی نمایش بودن ولی توی فرم ویرایش نبودن
    public $seller;

    public $mobile_seller;

    public $buyer;

    public $mobile_buyer;

    public $mileage;

    public $situation_mode;

    // مدیریت گالری تصاویر
    public $existing_images = [];

    public $new_images = [];

    public $alert_mode = 0;

    #[Layout('components.employee.edite-post')]
    public function mount($post_id)
    {
        $this->find_id = Specifications::find($post_id);

        // نکته‌ی مهم: قبلاً این بخش وجود نداشت، برای همین فیلدهای فرم موقع
        // باز شدن صفحه خالی دیده می‌شدن (چون wire:model.fill مقدار رو از
        // property های کامپوننت می‌گیره، نه از attribute های HTML توی View).
        $this->identification_number = $this->find_id->identification_number;
        $this->plat_number = $this->find_id->plat_number;
        $this->model = $this->find_id->model;
        $this->color = $this->find_id->color;
        $this->car_name = $this->find_id->car_name;
//        $this->profit = $this->find_id->profit;
        $this->loss = $this->find_id->loss;
        $this->gearbox_type = $this->find_id->gearbox_type;
        $this->car_fuel_type = $this->find_id->car_fuel_type;
        $this->description = $this->find_id->description;
        $this->gear_type = $this->find_id->gear_type;
        $this->promise_number = $this->find_id->promise_number;
        $this->price_car = $this->find_id->price_car;
        $this->cylinder_type = $this->find_id->cylinder_type;
        $this->mileage = $this->find_id->mileage;
        $this->seller = $this->find_id->seller;
        $this->mobile_seller = $this->find_id->mobile_seller;
        $this->buyer = $this->find_id->buyer;
        $this->mobile_buyer = $this->find_id->mobile_buyer;
        $this->situation_mode = $this->find_id->situation_mode;

    $this->existing_images = $this->find_id->images ?? [];
    }

    public function render()
    {
        return view('livewire.employee.edite-post');
    }

    protected function rules(): array
    {
        return [
            'identification_number' => 'required|string|max:17',
            'plat_number' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'car_name' => 'required|string',
            'gearbox_type' => 'required|string',
            'car_fuel_type' => 'required|string',
            'gear_type' => 'required|string',
            'price_car' => 'required',
            'mileage' => 'required',
            'seller' => 'required|string',
            'mobile_seller' => 'required|string',
            'buyer' => 'nullable|string',
            'mobile_buyer' => 'nullable|string',
            'situation_mode' => 'required',
            'new_images.*' => 'nullable|image|max:2048', // حداکثر ۲ مگابایت هر عکس
        ];
    }

    // حذف فوری یک عکس از گالری (مستقل از submit فرم، هم از دیسک هم از دیتابیس)
    public function removeExistingImage($index)
    {
        if (! isset($this->existing_images[$index])) {
            return;
        }

        Storage::disk('public')->delete($this->existing_images[$index]);

        unset($this->existing_images[$index]);
        $this->existing_images = array_values($this->existing_images);

        // ذخیره‌ی فوری توی دیتابیس، تا اگه کاربر بدون زدن "بروزرسانی" هم صفحه
        // رو ترک کرد، عکس واقعاً حذف‌شده باقی بمونه (نه فقط توی state فرانت).
        Specifications::where('id', $this->find_id->id)->update([
            'images' => json_encode($this->existing_images),
        ]);
    }

    public function update($id)
    {
        $this->validate();

        // آپلود عکس‌های تازه انتخاب‌شده
        $newPaths = [];
        foreach ($this->new_images as $image) {
            $newPaths[] = $image->store('cars', 'public');
        }

        $allImages = array_merge($this->existing_images, $newPaths);

        $this->update_data = Specifications::where('id', $id)->update([
            'identification_number' => $this->identification_number,
            'plat_number' => $this->plat_number,
            'color' => $this->color,
            'model' => $this->model,
//            'profit' => $this->profit,
//            'loss' => $this->loss,
            'promise_number' => $this->promise_number,
            'car_fuel_type' => $this->car_fuel_type,
            'car_name' => $this->car_name,
            'cylinder_type' => $this->cylinder_type,
            'description' => $this->description,
            'price_car' => $this->price_car,
            'gearbox_type' => $this->gearbox_type,
            'gear_type' => $this->gear_type,
            'mileage' => $this->mileage,
            'seller' => $this->seller,
            'mobile_seller' => $this->mobile_seller,
            'buyer' => $this->buyer,
            'edited_by' => auth()->user()->phone_number,
            'mobile_buyer' => $this->mobile_buyer,
            'situation_mode' => $this->situation_mode,
            'images' => json_encode($allImages),
        ]);

        // ری‌ست کردن آپلود موقت + هماهنگ کردن state با چیزی که واقعاً ذخیره شد
        $this->new_images = [];
        $this->existing_images = $allImages;

        $this->alert_mode = 1;
    }

    public function close_alert()
    {
        $this->alert_mode = 0;
    }
}

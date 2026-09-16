<?php

namespace App\Livewire\Employee;

use App\Livewire\Actions\Logout;
use App\Models\Specifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmDashboard extends Component
{
    use WithFileUploads;

    public $search = '';

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

    public $promise_number;

    public $gear_type;

    public $cylinder_type;

    public $price_car;

    public $seller;

    public $mileage;

    public $mobile_seller;

    public $buyer;

    public $mobile_buyer;

    public $description;

    public $situation_mode;

    public $images = [];

    public $alert_mode = 0;

    #[Layout('components.employee.employee-dashboard')]
    public function render()
    {
        $query = Specifications::query()->latest('id');

        if (filled($this->search)) {
            $query->where(function ($q) {
                $q->where('car_name', 'like', '%'.$this->search.'%')
                    ->orWhere('identification_number', 'like', '%'.$this->search.'%')
                    ->orWhere('plat_number', 'like', '%'.$this->search.'%');
            });
        }

        $this->specifications = $query->limit(10)->get();

        return view('livewire.employee.em-dashboard');
    }

    public function search_car()
    {
        return redirect()->route('find_car', ['n_car_id' => $this->search]);
    }

    public function create()
    {
        $validate = $this->validate([
            'plat_number' => ['required', 'string', 'max:20'],
            'promise_number' => ['required', 'string', 'max:20'],

            'identification_number' => [
                'required',
                'string',
                'min:8',
                'max:17',
                'unique:specifications,identification_number',
            ],

            'color' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],

            'seller' => ['required', 'string', 'max:100'],
            'mobile_seller' => ['required', 'regex:/^09[0-9]{9}$/'],

            'buyer' => ['required', 'string', 'max:100'],
            'mobile_buyer' => ['required', 'regex:/^09[0-9]{9}$/'],

            'car_name' => ['required', 'string', 'max:100'],
            'car_fuel_type' => ['required'],
            'mileage' => ['required'],

            'description' => ['nullable', 'string', 'max:9999'],
            'cylinder_type' => ['required'],

            //            'profit' => ['required'],
            //            'loss' => ['required'],

            'price_car' => ['required', 'integer', 'min:0'],
            'gear_type' => ['required'],
            'gearbox_type' => ['required', 'string', 'max:50'],
            'situation_mode' => ['required'],

            'images' => ['required', 'array', 'min:1', 'max:5'],
            'images.*' => ['image', 'max:5120'],
        ]);

        // این متد خودش عکس‌ها را فشرده و ذخیره می‌کند
        $paths = $this->storeCarImages(
            $validate['images'],
        );

        DB::table('specifications')->insert([
            'submitted_by' => auth()->user()->id,
            'identification_number' => $validate['identification_number'],
            'plat_number' => $validate['plat_number'],
            'color' => $validate['color'],
            'model' => $validate['model'],
            'seller' => $validate['seller'],
            'mobile_seller' => $validate['mobile_seller'],
            'buyer' => $validate['buyer'],
            'mobile_buyer' => $validate['mobile_buyer'],
            'promise_number' => $validate['promise_number'],
            'car_fuel_type' => $validate['car_fuel_type'],
            'car_name' => $validate['car_name'],
            'cylinder_type' => $validate['cylinder_type'],
            'description' => $validate['description'],
            'price_car' => $validate['price_car'],
            'gearbox_type' => $validate['gearbox_type'],
            'mileage' => $validate['mileage'],
            'gear_type' => $validate['gear_type'],
            'situation_mode' => $validate['situation_mode'],
            //            'profit' => $validate['profit'],
            //            'loss' => $validate['loss'],
            'edited_by' => '...',
            'images' => json_encode($paths),
            'created_post' => jdate('Y/m/d'),
        ]);

        $this->reset([
            'identification_number',
            'plat_number',
            'color',
            'model',
            'seller',
            'mobile_seller',
            'buyer',
            'mobile_buyer',
            'car_name',
            'car_fuel_type',
            'description',
            'cylinder_type',
            'price_car',
            //            'profit',
            'mileage',
            //            'loss',
            'gear_type',
            'gearbox_type',
            'situation_mode',
            'images',
        ]);

        $this->alert_mode = 1;
    }

    private function storeCarImages(array $images): array
    {
        $paths = [];

        foreach ($images as $image) {

            $extension = strtolower($image->getClientOriginalExtension());

            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    $src = imagecreatefromjpeg($image->getRealPath());
                    break;

                case 'png':
                    $src = imagecreatefrompng($image->getRealPath());
                    break;

                case 'webp':
                    $src = imagecreatefromwebp($image->getRealPath());
                    break;

                default:
                    continue 2;
            }

            $width = imagesx($src);
            $height = imagesy($src);

            // فقط اگر عکس بزرگ‌تر از 1600 بود کوچک شود
            if ($width > 1600) {

                $newWidth = 1600;
                $newHeight = intval(($height * $newWidth) / $width);

                $dst = imagecreatetruecolor($newWidth, $newHeight);

                // برای PNG پس‌زمینه سفید
                $white = imagecolorallocate($dst, 255, 255, 255);
                imagefill($dst, 0, 0, $white);

                imagecopyresampled(
                    $dst,
                    $src,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $width,
                    $height
                );

                imagedestroy($src);
                $src = $dst;
            }

            $filename = uniqid().'.jpg';
            $path = "cars/{$filename}";

            ob_start();
            imagejpeg($src, null, 85); // کیفیت بالا
            $imageData = ob_get_clean();

            Storage::disk('public')->put($path, $imageData);

            imagedestroy($src);

            $paths[] = $path;
        }

        return $paths;
    }
    
    public function removeImage($index): void
{
    unset($this->images[$index]);
    $this->images = array_values($this->images);
}
    
    

    public function close_alert()
    {
        $this->alert_mode = 0;
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}

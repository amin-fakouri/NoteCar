<?php

namespace App\Livewire\Employee;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public $identification_number;

    public $plat_number;

    public $model;

    public $color;

    public $car_name;

    public $engine_type;

    public $engine_volume;

    public $gearbox_type;

    public $car_fuel_type;

    public $number_of_seats;

    public $gear_type;

    public $volume_buck_car;

    public $price_car;

    public $km_car;

    public $specifications;

    #[Layout('components.employee.employee-create')]
    public function render()
    {
        return view('livewire.employee.create');
    }

    public function create()
    {
        DB::table('specifications')->insert([
            'identification_number' => $this->identification_number,
            'plat_number' => $this->plat_number,
            'color' => $this->color,
            'model' => $this->model,
            'car_fuel_type' => $this->car_fuel_type,
            'car_name' => $this->car_name,
            'engine_type' => $this->engine_type,
            'volume_buck_car' => $this->volume_buck_car,
            'engine_volume' => $this->engine_volume,
            'price_car' => $this->price_car,
            'gearbox_type' => $this->gearbox_type,
            'gear_type' => $this->gear_type,
            'number_of_seats' => $this->number_of_seats,
            'km_car' => $this->km_car,
            'created_post' => jdate('Y/m/d'),
        ]);

        $this->reset(['identification_number',
            'plat_number',
            'color',
            'model',
            'car_name',
            'car_fuel_type',
            'engine_type',
            'volume_buck_car',
            'price_car',
            'gear_type',
            'engine_volume',
            'gearbox_type',
            'number_of_seats',
            'km_car',
        ]);
    }
}

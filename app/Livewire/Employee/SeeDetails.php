<?php

namespace App\Livewire\Employee;

use App\Models\Specifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class SeeDetails extends Component
{
    use WithPagination;

    // به‌جای sort_table (0/1) که دو تا کالکشن جدا نگه می‌داشت،
    // فقط جهت مرتب‌سازی رو نگه می‌داریم و یک کوئری واحد pagination می‌شه.
    public $sortDirection = 'desc';

    public $modal = 0;

    public $find_data;

    public $gallery_images = [];

    #[Layout('components.employee.see-details')]
    public function render()
    {
        $specifications = Specifications::orderBy('id', $this->sortDirection)
            ->paginate(15);

        return view('livewire.employee.see-details', [
            'specifications' => $specifications,
        ]);
    }

    public function sort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        $this->resetPage(); // مهم: با تغییر ترتیب، برگرد صفحه‌ی ۱ وگرنه ممکنه صفحه‌ی خالی ببینی
    }

    public function show_gallery($id)
    {
        $spec = DB::table('specifications')->find($id);
        $this->gallery_images = $spec ? (json_decode($spec->images, true) ?? []) : [];
        $this->modal = 2;
    }

    public function show_text()
    {
        $this->modal = 1;
    }

    public function close_modal()
    {
        $this->modal = 0;
        $this->gallery_images = [];
    }

    public function delete($id)
    {
        $spec = Specifications::findOrFail($id);

        $spec->deleted_by = auth()->id();
        $spec->save();
        $spec->delete();

        session()->flash('message', __('رکورد با موفقیت حذف شد.'));
    }

    public function find_id($id)
    {
        $this->find_data = Specifications::find($id);
        $this->modal = 1;
    }
}

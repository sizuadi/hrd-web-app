<?php

namespace App\Livewire\Pages\ArchiveCategories;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\ArchiveCategories\ArchiveCategoriesForm;
use App\Models\WorkTypeStatus;
use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryStatus;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Arsip Kategori')]
class ArchiveCategoriesIndex extends Component
{

    use WithPagination;

    // init variable
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $status = "";
    public $currentPage = 1;
    public $paginate = 5;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortIcon = "arrow-up";
    public $mode = "";

    // for create
    public ArchiveCategoriesForm $form;

    public $status_id, $status_name, $work_type;

    public function sorting($columnName = "")
    {
        if ($this->sortOrder == "asc") {
            $this->sortOrder = "desc";
            $this->sortIcon = "arrow-down";
        } else {
            $this->sortOrder = "asc";
            $this->sortIcon = "arrow-up";
        }

        $this->orderColumn = $columnName;
    }

    public function changeModalMode($mode = "", $id = 0)
    {
        $this->mode = $mode;
        if ($id != 0 && ($mode == "update" || $mode == "show")) {
            $work_type = ArchiveCategory::find($id);
            $this->form->id = $work_type->id;
            $this->form->name = $work_type->name;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
    }

    public function resetForm()
    {
        $this->form->id = "";
        $this->form->name = "";
    }

    public function store()
    {
        $this->validate();
        ArchiveCategory::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Arsip Kategori Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {

        $archive_category = ArchiveCategory::find($this->form->id);
        $archive_category->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Arsip Kategori Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $archive_category = ArchiveCategory::find($this->work_type->id);
        $archive_category->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Arsip Kategori Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->work_type = ArchiveCategory::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = ArchiveCategory::query();

        if ($this->search) {
            $datas = $datas->where('name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = ArchiveCategoryStatus::orderBy("id", "desc")->get();

        return view('livewire.pages.archive-categories.archive-categories-index', [
            'datas' => $datas,
            'statuses' => $statuses,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

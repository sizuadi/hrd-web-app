<?php

namespace App\Livewire\Pages\WorkTypes;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\WorkTypes\WorkTypesForm;
use App\Models\WorkTypeStatus;
use App\Models\WorkType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Tipe Pekerjaan')]
class WorkTypesIndex extends Component
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
    public WorkTypesForm $form;

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
            $work_type = WorkType::find($id);
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
        WorkType::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Tipe Pekerjaan Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {

        $worktype = WorkType::find($this->form->id);
        $worktype->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Tipe Pekerjaan Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $worktype = WorkType::find($this->work_type->id);
        $worktype->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Tipe Pekerjaan Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->work_type = WorkType::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = WorkType::query();

        if ($this->search) {
            $datas = $datas->where('name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = WorkTypeStatus::orderBy("id", "desc")->get();

        return view('livewire.pages.work-types.work-types-index', [
            'datas' => $datas,
            'statuses' => $statuses,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

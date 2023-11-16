<?php

namespace App\Livewire\Pages\Companies;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Companies\CompaniesForm;
use App\Models\Company;
use App\Models\CompanyStatus;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Company')]
class CompaniesIndex extends Component
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
    public CompaniesForm $form;

    public $status_id, $status_name, $company;

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
            $company = Company::find($id);
            $this->form->id = $company->id;
            $this->form->name = $company->name;
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
        Company::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Perusahaan Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {

        $company = Company::find($this->form->id);
        $company->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Perusahaan Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $company = Company::find($this->company->id);
        $company->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Perusahaan Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->company = Company::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = Company::query();

        if ($this->search) {
            $datas = $datas->where('name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = CompanyStatus::orderBy("id", "desc")->get();

        return view('livewire.pages.companies.companies-index', [
            'datas' => $datas,
            'statuses' => $statuses,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

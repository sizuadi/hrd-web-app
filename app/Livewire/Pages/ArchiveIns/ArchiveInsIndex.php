<?php

namespace App\Livewire\Pages\ArchiveIns;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\ArchiveIns\ArchiveInsForm;
use App\Models\ArchiveCategory;
use App\Models\ArchiveIn;
use App\Models\ArchiveInstatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Archive In')]
class ArchiveInsIndex extends Component
{
    use WithPagination, WithFileUploads;

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
    public $file;

    // for create
    public ArchiveInsForm $form;

    public $status_id, $status_name, $user_project;

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
            $user_project = ArchiveIn::find($id);
            $this->form->id = $user_project->id;
            $this->form->archive_category_id = $user_project->archive_category_id;
            $this->form->date = $user_project->date;
            $this->form->archive_number = $user_project->archive_number;
            $this->form->source = $user_project->source;
            $this->form->subject = $user_project->subject;
            $this->form->archive_file = $user_project->archive_file;
            $this->form->description = $user_project->description;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
        $this->dispatch("flatpickr");
    }

    public function resetForm()
    {
        $this->form->id = "";
        $this->form->archive_category_id = 0;
        $this->form->date = "";
        $this->form->archive_number = "";
        $this->form->source = "";
        $this->form->subject = "";
        $this->form->archive_file = "";
        $this->form->description = "";
    }

    public function store()
    {
        $this->validate();
        $this->file = $this->form->archive_file;
        $name = md5($this->file . microtime()) . '.' . $this->file->extension();
        $this->file->storeAs('archive-in', $name);
        $this->form->archive_file = "archive-in/" . $name;
        ArchiveIn::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();
        $this->file = $this->form->archive_file;
        $name = md5($this->file . microtime()) . '.' . $this->file->extension();
        $this->file->storeAs('archive-in', $name);
        $this->form->archive_file = "archive-in/" . $name;
        $user_project = ArchiveIn::find($this->form->id);
        $user_project->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $user_project = ArchiveIn::find($this->user_project->id);
        $user_project->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->user_project = ArchiveIn::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function updated()
    {
        $this->dispatch("choices");
    }

    public function render()
    {
        $datas = DB::table("archive_ins")->selectRaw("archive_ins.*,
        archive_categories.name as archive_categories_name, archive_in_statuses.name as status_name")
            ->join("archive_categories", "archive_ins.archive_category_id", "archive_categories.id")
            ->join("archive_in_statuses", "archive_ins.status_id", "archive_in_statuses.id");

        if ($this->search) {
            $datas = $datas->where('archive_number', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = ArchiveInstatus::orderBy("id", "desc")->get();
        $archive_categories = ArchiveCategory::where("status_id", 1)->get();

        if (count($this->getErrorBag()->all()) > 0) {
            $this->dispatch("choices");
        }
        return view('livewire.pages.archive-ins.archive-ins-index', [
            'datas' => $datas,
            'statuses' => $statuses,
            'archive_categories' => $archive_categories,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

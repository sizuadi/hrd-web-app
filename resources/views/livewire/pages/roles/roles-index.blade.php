<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Role</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header pb-0 justify-content-between d-flex align-items-center">
                    <div class="form-group">
                    </div>
                    <div class="form-group mb-0">
                        <button data-bs-toggle="modal" data-bs-target="#modal-form" type="button"
                            class="btn btn-primary" wire:click="changeModalMode('create')">Create
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center row">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-5 d-flex align-items-center">
                                <div>Show</div>
                                <select class="form-select mx-1" wire:model.live="paginate">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                                <div>entries</div>
                            </div>
                            <div class="col-sm-4 mt-sm-0 mt-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search"
                                        wire:model.live="search">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="d-flex align-items-center @if ($orderColumn == 'id') text-primary @endif"
                                                wire:click="sorting('id')" role="button">
                                                <div>#</div>
                                                @if ($orderColumn == 'id')
                                                    <svg class="bi" width="1em" height="1em"
                                                        fill="currentColor">
                                                        <use
                                                            xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#') . $sortIcon }}">
                                                        </use>
                                                    </svg>
                                                @endif
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>
                                            <div class="d-flex align-items-center @if ($orderColumn == 'name') text-primary @endif"
                                                wire:click="sorting('name')" role="button">
                                                <div>NAME</div>
                                                @if ($orderColumn == 'name')
                                                    <svg class="bi" width="1em" height="1em"
                                                        fill="currentColor">
                                                        <use
                                                            xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#') . $sortIcon }}">
                                                        </use>
                                                    </svg>
                                                @endif
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $datas->firstItem() + $key }}</td>
                                            <td class="text-bold-500">
                                                <div class="d-flex">
                                                    <button wire:click="changeModalMode('update', {{ $data->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#modal-form"
                                                        class="btn icon btn-md btn-outline-info" title="edit">
                                                        <i class="bi bi-pencil">
                                                            <div></div>
                                                        </i>
                                                    </button>
                                                    <a wire:click="changeModalMode('show', {{ $data->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#modal-form"
                                                        class="btn icon btn-md btn-outline-info" title="show">
                                                        <i class="bi bi-eye">
                                                            <div></div>
                                                        </i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-bold-500">{{ $data->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="justify-content-between align-items-center row mt-3">
                            {{ $datas->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('livewire.pages.roles.partials.modal-form')
</div>

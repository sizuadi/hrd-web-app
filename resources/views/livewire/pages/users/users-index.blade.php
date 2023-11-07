<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header pb-0 justify-content-between d-flex">
                    <a href="#" class="btn btn-primary">Create</a>
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
                                        <th>
                                            <div class="d-flex align-items-center @if ($orderColumn == 'full_name') text-primary @endif"
                                                wire:click="sorting('full_name')" role="button">
                                                <div>NAME</div>
                                                @if ($orderColumn == 'full_name')
                                                    <svg class="bi" width="1em" height="1em"
                                                        fill="currentColor">
                                                        <use
                                                            xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#') . $sortIcon }}">
                                                        </use>
                                                    </svg>
                                                @endif
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex align-items-center @if ($orderColumn == 'email') text-primary @endif"
                                                wire:click="sorting('email')" role="button">
                                                <div>EMAIL</div>
                                                @if ($orderColumn == 'email')
                                                    <svg class="bi" width="1em" height="1em"
                                                        fill="currentColor">
                                                        <use
                                                            xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#') . $sortIcon }}">
                                                        </use>
                                                    </svg>
                                                @endif
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex align-items-center @if ($orderColumn == 'username') text-primary @endif"
                                                wire:click="sorting('username')" role="button">
                                                <div>USERNAME</div>
                                                @if ($orderColumn == 'username')
                                                    <svg class="bi" width="1em" height="1em"
                                                        fill="currentColor">
                                                        <use
                                                            xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg#') . $sortIcon }}">
                                                        </use>
                                                    </svg>
                                                @endif
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex align-items-center">
                                                <div>ROLE</div>
                                                <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                    <use
                                                        xlink:href="{{ asset('assets/static/images/bootstrap-icons.svg') }}">
                                                    </use>
                                                </svg>
                                            </div>
                                        </th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $datas->firstItem() + $key }}</td>
                                            <td class="text-bold-500">{{ $data->full_name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td class="text-bold-500">{{ $data->username }}</td>
                                            <td class="text-bold-500">{{ $data->roles()->first()->name }}</td>
                                            <td class="text-bold-500">{{ $data->status()->first()->name }}</td>
                                            <td class="text-bold-500">
                                                <a href="#" class="btn btn-success">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
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
</div>

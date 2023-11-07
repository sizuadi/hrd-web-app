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
                <div class="card-header pb-0 justify-content-end d-flex">
                    <a href="#" class="btn btn-primary">Create</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center row">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 d-flex align-items-center">
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
                                        wire:model.live="query">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive-xl">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>USERNAME</th>
                                        <th>ROLE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td class="text-bold-500">{{ $key + 1 }}</td>
                                            <td class="text-bold-500">{{ $data->full_name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td class="text-bold-500">{{ $data->username }}</td>
                                            <td class="text-bold-500">{{ $data->roles()->first()->name }}</td>
                                            <td class="text-bold-500">{{ $data->status()->first()->name }}</td>
                                            <td class="text-bold-500">test</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $datas->links() }}
                        </div>
                        <div class="justify-content-between align-items-center row">
                            <div class="col-sm-6 d-flex align-items-center">
                                <div>Showing 1 to 10 of 123 entries</div>
                            </div>
                            <div class="col-sm-6 mt-sm-0 mt-2 justify-content-end d-flex">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-primary">
                                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

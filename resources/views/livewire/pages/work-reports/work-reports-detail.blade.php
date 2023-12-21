<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Update Work Hour : {{ $work_report->project_name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active"><a href="/work-reports" wire:navigate>Work Report</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <input type="text" class="form-control" id="company_id"
                                wire:model="work_report.company_name" placeholder="Company Name" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="project_id">Project</label>
                            <input type="text" class="form-control" id="project_id"
                                wire:model="work_report.project_name" placeholder="Project Name" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" class="form-control" id="start_date"
                                wire:model="work_report.start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" class="form-control" id="end_date" wire:model="work_report.end_date"
                                placeholder="End Date" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="end_date">Status</label>
                            <input type="text" class="form-control" id="status"
                                wire:model="work_report.status_name" placeholder="Status Name" readonly>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <tr>
                                <th>#</th>
                                <th>Module</th>
                                <th>Link</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Days</th>
                                <th>Hours</th>
                                <th>Delete</th>
                            </tr>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 200px;">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 200px;">
                                </td>
                                <td>
                                    <textarea name="" class="form-control" id="" rows="2" style="width: 200px;"></textarea>
                                </td>
                                <td>
                                    <select name="" id="" class="form-control" style="width: 200px;">
                                        <option value="1">Test</option>
                                        <option value="1">Test</option>
                                        <option value="1">Test</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 200px;">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 200px;">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary">Add +</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

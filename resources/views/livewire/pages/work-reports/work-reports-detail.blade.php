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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="/work-reports">Work Report</a>
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
                            @foreach ($work_report_details as $key => $detail)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        <input type="text"
                                            wire:model="work_report_details.{{ $key }}.module"
                                            class="form-control" style="width: 200px;">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="work_report_details.{{ $key }}.link"
                                            class="form-control" style="width: 200px;">
                                    </td>
                                    <td>
                                        <textarea class="form-control" wire:model="work_report_details.{{ $key }}.description" rows="2"
                                            style="width: 200px;"></textarea>
                                    </td>
                                    <td>
                                        <select class="form-control"
                                            wire:model="work_report_details.{{ $key }}.work_type_id"
                                            style="width: 200px;">
                                            @foreach ($work_types as $work_type)
                                                <option value="{{ $work_type->id }}">{{ $work_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" wire:model="work_report_details.{{ $key }}.day"
                                            class="form-control" style="width: 200px;">
                                    </td>
                                    <td>
                                        <input type="number" wire:model="work_report_details.{{ $key }}.hour"
                                            class="form-control" style="width: 200px;">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-danger"
                                            wire:click="removeWorkReportDetail({{ $key }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" wire:click="addWorkReportDetail">Add +</button>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success" wire:click="update">Update</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

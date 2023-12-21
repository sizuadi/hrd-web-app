<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords($mode) }} User Project</h5>
                    <button type="button" class="close rounded-pill" wire:click="resetForm" data-bs-dismiss="modal"
                        wire:ignore aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" wire:model="form.id">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="project_id">Project</label>
                                <div class="form-group">
                                    <select class="choices form-select"
                                        @if ($mode == 'show') disabled @endif id="project_id"
                                        wire:model.change="form.project_id"
                                        wire:change="$set('form.project_id', $event.target.value)">
                                        <option value="">Select an option</option>
                                        @foreach ($projects as $key => $project)
                                            <option value="{{ $project->id }}" :key="{{ $key }}">
                                                {{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.project_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="company_id">Company</label>
                                <input type="text"
                                    class="form-control @error('form.company_id') is-invalid @enderror" id="company_id"
                                    wire:model="form.company_name" placeholder="Company Name" readonly>
                                <input type="hidden" wire:model="form.company_id">
                                @error('form.company_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label for="user_id">Pekerja</label>
                                <div class="form-group">
                                    <select class="choices form-select" id="user_id" wire:model="form.user_id"
                                        @if ($mode == 'show') disabled @endif
                                        wire:change="$set('form.user_id', $event.target.value)">
                                        <option value="">Select an option</option>
                                        @foreach ($users as $key => $user)
                                            <option value="{{ $user->id }}" :key="{{ $key }}">
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="@error('form.user_id') is-invalid @enderror"></div>
                                    @error('form.user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label for="start_date">Start Date</label>
                                <input type="text"
                                    class="form-control @error('form.start_date') is-invalid @enderror"
                                    @if ($mode != 'show') id="start_date" @endif
                                    wire:model="form.start_date" placeholder="Start Date" readonly>
                                @error('form.start_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control @error('form.end_date') is-invalid @enderror"
                                    @if ($mode != 'show') id="end_date" @endif wire:model="form.end_date"
                                    placeholder="End Date" readonly>
                                @error('form.end_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="resetForm" class="btn btn-light-primary"
                            data-bs-dismiss="modal" class="btn btn-light-primary">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        @if ($mode == 'update' || $mode == 'create')
                            <button type="button" wire:click.prevent="{{ $mode == 'update' ? 'update' : 'store' }}"
                                class="btn btn-primary ms-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('add-scripts')
    <script type="module">
        document.addEventListener('flatpickr', function() {
            setTimeout(() => {
                let startDatePicker = flatpickr("#start_date", {
                    dateFormat: "Y-m-d",
                    allowInput: false,
                    maxDate: document.getElementById("end_date").value,
                    onClose: function(selectedDates, dateStr, instance) {
                        endDatePicker.set('minDate', dateStr);
                    },
                });
                let endDatePicker = flatpickr("#end_date", {
                    dateFormat: "Y-m-d",
                    minDate: document.getElementById("start_date").value,
                    onClose: function(selectedDates, dateStr, instance) {
                        startDatePicker.set('maxDate', dateStr);
                    },
                });
            }, 100);
        })
    </script>
@endpush

<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords($mode) }} Proyek</h5>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('form.name') is-invalid @enderror"
                                    id="name" wire:model="form.name" placeholder="Name"
                                    @if ($mode == 'show') readonly @endif>
                                @error('form.name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="company_id">Perusahaan</label>
                                <div class="form-group">
                                    <select class="choices form-select" id="company_id" wire:model="form.company_id"
                                        wire:ignore @if ($mode == 'show') disabled @endif>
                                        <option value="">Select an option</option>
                                        @foreach ($companies as $key => $company)
                                            <option value="1" :key="{{ $key }}">
                                                {{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.company_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('form.description') is-invalid @enderror" id="description"
                                    wire:model="form.description" placeholder="Description" rows="2"
                                    @if ($mode == 'show') readonly @endif></textarea>
                                @error('form.description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                    defaultDate: "today",
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

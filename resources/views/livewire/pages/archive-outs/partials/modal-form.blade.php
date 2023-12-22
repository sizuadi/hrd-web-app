<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords($mode) }} Archive ins</h5>
                    <button type="button" class="close rounded-pill" wire:click="resetForm" data-bs-dismiss="modal"
                        wire:ignore aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" wire:model="form.id">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="archive_category_id">Archive Category</label>
                                <div class="form-group">
                                    <select class="choices form-select"
                                        @if ($mode == 'show') disabled @endif id="archive_category_id"
                                        wire:model.change="form.archive_category_id"
                                        wire:change="$set('form.archive_category_id', $event.target.value)">
                                        <option value="">Select an option</option>
                                        @foreach ($archive_categories as $key => $archive_category)
                                            <option value="{{ $archive_category->id }}" :key="{{ $key }}">
                                                {{ $archive_category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.archive_category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="date">Date</label>
                                <input type="text" class="form-control @error('form.date') is-invalid @enderror"
                                    @if ($mode != 'show') id="date" @endif wire:model="form.date"
                                    placeholder="Date" readonly>
                                @error('form.date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label for="archive_number">Archive Number</label>
                                <input type="text"
                                    class="form-control @error('form.archive_number') is-invalid @enderror"
                                    id="archive_number" @if ($mode == 'show') readonly @endif
                                    wire:model="form.archive_number" placeholder="Archive Number">
                                @error('form.archive_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="source">Source</label>
                                <input type="text" class="form-control @error('form.source') is-invalid @enderror"
                                    id="source" wire:model="form.source"
                                    @if ($mode == 'show') readonly @endif placeholder="Source">
                                @error('form.source')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control @error('form.subject') is-invalid @enderror"
                                    id="subject" wire:model="form.subject"
                                    @if ($mode == 'show') readonly @endif placeholder="Subject">
                                @error('form.subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="archive_file" class="d-block">Archive File</label>
                                @if ($mode == 'show')
                                    <a href="{{ asset('storage/' . $form->archive_file) }}" class="btn btn-primary"
                                        target="_blank">File</a>
                                @else
                                    <input type="file"
                                        class="form-control @error('form.archive_file') is-invalid @enderror"
                                        id="archive_file" wire:model="form.archive_file"
                                        @if ($mode == 'show') readonly @endif placeholder="Archive File">
                                    @error('form.archive_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('form.description') is-invalid @enderror" id="description"
                                    wire:model="form.description" @if ($mode == 'show') readonly @endif rows="3"
                                    placeholder="Description"></textarea>
                                @error('form.description')
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
                let startDatePicker = flatpickr("#date", {
                    dateFormat: "Y-m-d",
                    allowInput: false,
                });
            }, 100);
        })
    </script>
@endpush

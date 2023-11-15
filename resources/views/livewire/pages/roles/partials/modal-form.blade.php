<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords($mode) }} Role</h5>
                    <button type="button" class="close rounded-pill" wire:click="resetForm" data-bs-dismiss="modal"
                        wire:ignore aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        @if ($mode == 'update' || $mode == 'create')
                            <input type="hidden" wire:model="form.id">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                            class="form-control @error('form.name') is-invalid @enderror" id="name"
                                            wire:model="form.name" placeholder="Name">
                                        @error('form.name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Permission</label>
                                            <div class="form-check form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox-all-permisssion"
                                                        class="form-check-input" wire:model.live="checkedAll">
                                                    <label for="checkbox-all-permisssion">Check All</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach ($custom_permissions as $key => $custom_permission)
                                            <div class="col-sm-6 form-group">
                                                <label>{{ ucwords($key) }}</label>
                                                @foreach ($custom_permission as $permission)
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="checkbox{{ $permission->id }}"
                                                                class="form-check-input checkbox-permission"
                                                                wire:model.live="checked_permissions"
                                                                value="{{ $permission->name }}">
                                                            <label
                                                                for="checkbox{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" wire:model="form.name"
                                        placeholder="Name" disabled>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Permission</label>
                                            <div class="form-check form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox-all-permisssion"
                                                        class="form-check-input" wire:model.live="checkedAll" disabled>
                                                    <label for="checkbox-all-permisssion">Check All</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach ($custom_permissions as $key => $custom_permission)
                                            <div class="col-sm-6 form-group">
                                                <label>{{ ucwords($key) }}</label>
                                                @foreach ($custom_permission as $permission)
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="checkbox{{ $permission->id }}"
                                                                class="form-check-input checkbox-permission"
                                                                wire:model.live="checked_permissions"
                                                                value="{{ $permission->name }}" disabled>
                                                            <label
                                                                for="checkbox{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

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
@endpush

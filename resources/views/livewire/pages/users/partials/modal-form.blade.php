<div>
    <div wire:ignore.self class="modal fade text-left modal-borderless" id="modal-form" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ ucwords($mode) }} User</h5>
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
                                    <label for="full_name">Full Name</label>
                                    <input type="text"
                                        class="form-control @error('form.full_name') is-invalid @enderror"
                                        id="full_name" wire:model="form.full_name" placeholder="Full Name">
                                    @error('form.full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="username">Username</label>
                                    <input type="text"
                                        class="form-control @error('form.username') is-invalid @enderror" id="username"
                                        wire:model="form.username" placeholder="Username">
                                    @error('form.username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row
                                        mt-4">
                                <div class="col-sm-6">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control @error('form.password') is-invalid @enderror" id="password"
                                        wire:model="form.password" placeholder="Password">
                                    @error('form.password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password"
                                        class="form-control @error('form.password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" wire:model="form.password_confirmation"
                                        placeholder="Password Confirmation">
                                    @error('form.password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row
                                            mt-4">
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('form.email') is-invalid @enderror"
                                        id="email" wire:model="form.email" placeholder="Email">
                                    @error('form.email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="rate_per_hour">Rate / Hour</label>
                                    <input type="number"
                                        class="form-control @error('form.rate_per_hour') is-invalid @enderror"
                                        id="rate_per_hour" wire:model="form.rate_per_hour" placeholder="Rate / Hour">
                                    @error('form.rate_per_hour')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row
                                            mt-4">
                                <div class="col-sm-6">
                                    <label for="role">Role</label>
                                    <div class="form-group">
                                        <select class="choices form-select @error('form.role') is-invalid @enderror"
                                            id="role" wire:model="form.role" wire:ignore>
                                            <option value="">Select an option</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name"
                                        wire:model="form.full_name" placeholder="Full Name" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" wire:model="form.username"
                                        placeholder="Username" disabled>
                                </div>
                            </div>
                            <div class="row
                                            mt-4">
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email"
                                        wire:model="form.email" placeholder="Email" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label for="rate_per_hour">Rate / Hour</label>
                                    <input type="number" class="form-control" id="rate_per_hour"
                                        wire:model="form.rate_per_hour" placeholder="Rate / Hour" disabled>
                                </div>
                            </div>
                            <div class="row
                                            mt-4">
                                <div class="col-sm-6">
                                    <label for="role">Role</label>
                                    <div class="form-group">
                                        <select class="choices form-select" id="role" wire:model="form.role"
                                            wire:ignore disabled>
                                            <option value="">Select an option</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $form->role == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
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

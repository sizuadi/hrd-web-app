<div>
    <div class="row justify-content-center h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo text-center">
                    <a href="#"><img src="{{ asset('assets/img/atomic-hrd-system.png') }}" alt="Logo" /></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-5">Login</h2>
                        <form wire:submit="login">
                            <div
                                class="form-group position-relative has-icon-left @error('form.username') is-invalid @enderror">
                                <input type="text" class="form-control" placeholder="Username"
                                    wire:model="form.username" />
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            @error('form.username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div
                                class="form-group position-relative has-icon-left mt-4 @error('form.username') is-invalid @enderror">
                                <input type="password" class="form-control " placeholder="Password"
                                    wire:model="form.password" />
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            @error('form.password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                                Log in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

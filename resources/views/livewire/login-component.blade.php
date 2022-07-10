<div>
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/icons/gmahkLogo.png') }}" alt="Logo" width="100">
                    </div>
                    <h2 class="mb-3 text-center"><strong>Konfrens DKI</strong></h2>

                    <!-- /Logo -->
                    <h4 class="mb-2 text-center">Welcome to JLC Chaudit! 👋</h4>
                    <p class="mb-4 text-center">Please sign-in to your account and start the audith</p>

                    <form wire:submit.prevent="checkUserLogin" class="mb-3">
                        <hr>
                        <div class="mb-3 mt-4">
                            <input type="email" class="form-control" id="email" @error('email') is-invalid @enderror wire:model.defer="email"
                                placeholder="Enter your email or username" autofocus />
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" @error('password') is-invalid @enderror wire:model.defer="password"
                                    placeholder="************" aria-describedby="password"
                                    autocomplete="current-password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember_me" wire:model="remember" />
                                <label class="form-check-label" for="remember_me"> Remember Me </label>
                            </div>
                            <a href="">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>
                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ route('register') }}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
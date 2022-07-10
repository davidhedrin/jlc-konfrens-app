<div>
    <div class="authentication-wrapper2 authentication-basic2 container-p-y">
        <div class="authentication-inner2">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/icons/gmahkLogo.png') }}" alt="Logo" width="100">
                    </div>
                    <h2 class="mb-3 text-center"><strong>Konfrens DKI</strong></h2>

                    <h4 class="mb-2 text-center">Adventure JLC Caudith 🚀</h4>
                    <p class="mb-2 text-center">Make your app management easy and fun!</p>
                    <p class="mb-4 text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span>Login Here</span>
                        </a>
                    </p>

                    <form wire:submit.prevent="storeAddNewUser" class="mb-3">
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jemaat_id" class="form-label">Jemaat</label>
                                <select class="form-select" id="jemaat_id" wire:model="jemaat_id" wire:click="generateUserId">
                                    <option value="">Pilih Jemaat</option>
                                    @foreach ($jemaats as $jem)
                                    <option value="{{ $jem->id }}">{{ $jem->nama_jemaat }}</option>
                                    @endforeach
                                </select>
                                @error('jemaat_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jabatan_id" class="form-label">Jabatan</label>
                                <select class="form-select"  wire:model="jabatan_id" id="jabatan_id" wire:click="generateUserId">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatans as $jab)
                                    <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="user_id" wire:model="user_id" placeholder="User ID Otomatis Terisi" readonly />
                                @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Fullname</label>
                                <input type="text" class="form-control" id="name" wire:model="name" placeholder="Masukkan Nama Lengkap" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model="email" placeholder="Masukkan Alamat Email" />
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_phone" class="form-label">Nomor Hp</label>
                                <input type="text" class="form-control" id="no_phone" wire:model="no_phone" placeholder="Masukkan Nomor Telpon" />
                                @error('no_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" wire:model="password"
                                            placeholder="************" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 form-password-toggle">
                                    <label class="form-label" for="password_confirmation">C-Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            wire:model="conf_pass" placeholder="************" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('conf_pass') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" />
                                <label for="terms">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                        class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                        Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                        class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                        Policy').'</a>',
                                    ]) !!}
                                </label>
                            </div>
                        </div>
                        @endif --}}
                        <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
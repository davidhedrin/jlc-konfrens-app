<div>
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div>
                            <span class="fw-semibold d-block mb-1">Sertifikat Terdaftar</span>
                            <h3 class="card-title mb-2"><span class="text-info">{{ $assets->count() }} </span><span
                                    style="font-weight:100">Sertifikat</span></h3>
                            <small class="text-primary fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $asset1Week->count()
                                }} Sertifikat baru Minggu ini</small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-label-primary"><i class='bx bx-award'
                                    style="font-size: 45px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div>
                            <span class="fw-semibold d-block mb-1">Users Terdaftar</span>
                            <h3 class="card-title mb-2"><span class="text-info">{{ $users->count() }}</span> <span
                                    style="font-weight:100">User</span></h3>
                            <small class="text-primary fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $user1Week->count() }}
                                User baru Minggu ini</small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-label-primary"><i class='bx bx-user'
                                    style="font-size: 45px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div>
                            <span class="fw-semibold d-block mb-1">Jemaat Terdaftar</span>
                            <h3 class="card-title mb-2"><span class="text-info">{{ $jemaats->count() }}</span> <span
                                    style="font-weight:100">Jemaat</span></h3>
                            <small class="text-primary fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $jemaat1Week->count()
                                }} Jemaat baru Minggu ini</small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-label-primary"><i class='bx bx-church'
                                    style="font-size: 45px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div>
                            <span class="fw-semibold d-block mb-1">Jabatan Terdaftar</span>
                            <h3 class="card-title mb-2"><span class="text-info">{{ $jabatan->count() }}</span> Jabatan</h3>
                            <small class="text-primary fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ $jabatan1Week->count()
                                }} Jabatan baru Minggu ini</small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-label-primary"><i class='bx bx-user-pin'
                                    style="font-size: 45px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="component-footer">
        <footer class="footer bg-light">
            <div
                class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                <div>
                    <span class="footer-text" style="font-size: 18px">{{ $profile->name }}</span>
                </div>
                <div>
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger"><i
                            class="bx bx-log-out-circle"></i> Logout</a>
                </div>
            </div>
        </footer>
    </section>
    {{-- <div class="container-p-y pt-0">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height: 500px">
                <div class="carousel-item active" style="height: 500px">
                    <img class="d-block w-100" src="../assets/img/elements/13.jpg" alt="First slide" height="500" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>First slide</h3>
                        <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 500px">
                    <img class="d-block w-100" src="../assets/img/elements/2.jpg" alt="Second slide" height="500" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide</h3>
                        <p>In numquam omittam sea.</p>
                    </div>
                </div>
                <div class="carousel-item" style="height: 500px">
                    <img class="d-block w-100" src="../assets/img/elements/18.jpg" alt="Third slide" height="500" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Third slide</h3>
                        <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div> --}}
</div>
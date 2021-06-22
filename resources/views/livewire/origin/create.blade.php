<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Asal</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('origin.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('origin.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Tambah Asal</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveOrigin" autocomplete="off">

                            <div class="px-lg-2">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('origin_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-origin_name">{{ __('Nama Asal') }}</label>
                                        <input
                                            type="text"
                                            name="origin_name"
                                            id="input-origin_name"
                                            class="form-control form-control-alternative{{ $errors->has('origin_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Asal') }}"
                                            required
                                            autofocus
                                            wire:model="origin_name">

                                        @if ($errors->has('origin_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('origin_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('origin_address') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-origin_address">{{ __('Alamat Asal') }}</label>
                                        <textarea
                                            name="origin_address"
                                            id="input-origin_address"
                                            class="form-control form-control-alternative{{ $errors->has('origin_address') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Alamat Asal') }}"
                                            required
                                            autofocus
                                            wire:model="origin_address">
                                        </textarea>

                                        @if ($errors->has('origin_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('origin_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('origin.index') }}" class="btn btn-danger mt-2">{{ __('Batal') }}</a>
                                    <button type="submit" class="btn btn-success mt-2">{{ __('Simpan') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

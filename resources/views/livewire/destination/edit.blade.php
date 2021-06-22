<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tujuan</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('destination.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('destination.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ubah Asal</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveDestination" autocomplete="off">

                            <div class="px-lg-2">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('destination_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-destination_name">{{ __('Nama Tujuan') }}</label>
                                        <input
                                            type="text"
                                            name="destination_name"
                                            id="input-destination_name"
                                            class="form-control form-control-alternative{{ $errors->has('destination_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Tujuan') }}"
                                            required
                                            autofocus
                                            wire:model="destination_name">

                                        @if ($errors->has('destination_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('destination_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('destination_address') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-destination_address">{{ __('Alamat Tujuan') }}</label>
                                        <textarea
                                            name="destination_address"
                                            id="input-destination_address"
                                            class="form-control form-control-alternative{{ $errors->has('destination_address') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Alamat Tujuan') }}"
                                            required
                                            autofocus
                                            wire:model="destination_address">
                                        </textarea>

                                        @if ($errors->has('destination_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('destination_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('destination.index') }}" class="btn btn-danger mt-2">{{ __('Batal') }}</a>
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

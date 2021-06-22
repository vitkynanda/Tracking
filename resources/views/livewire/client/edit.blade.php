<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Client</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('client.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('client.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ubah Client</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveClient" autocomplete="off">

                            <div class="px-lg-2">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('client_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-client_name">{{ __('Nama Client') }}</label>
                                        <input
                                            type="text"
                                            name="client_name"
                                            id="input-client_name"
                                            class="form-control form-control-alternative{{ $errors->has('client_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Client') }}"
                                            required
                                            autofocus
                                            wire:model="client_name">

                                        @if ($errors->has('client_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('client_phone') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-client_phone">{{ __('Telepon Client') }}</label>
                                        <input
                                            type="phone"
                                            name="client_phone"
                                            id="input-client_phone"
                                            class="form-control form-control-alternative{{ $errors->has('client_phone') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Telepon Client') }}"
                                            required
                                            autofocus
                                            wire:model="client_phone">

                                        @if ($errors->has('client_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('client_email') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-client_name">{{ __('Email Client') }}</label>
                                        <input
                                            type="email"
                                            name="client_email"
                                            id="input-client_email"
                                            class="form-control form-control-alternative{{ $errors->has('client_email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email Client') }}"
                                            required
                                            autofocus
                                            wire:model="client_email">

                                        @if ($errors->has('client_email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('client_address') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-client_name">{{ __('Alamat Client') }}</label>
                                        <textarea
                                            name="client_address"
                                            id="input-client_address"
                                            class="form-control form-control-alternative{{ $errors->has('client_address') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Alamat Client') }}"
                                            required
                                            autofocus
                                            wire:model="client_address">
                                        </textarea>

                                        @if ($errors->has('client_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('client.index') }}" class="btn btn-danger mt-2">{{ __('Batal') }}</a>
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

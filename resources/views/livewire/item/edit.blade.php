<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Item</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('item.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('item.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ubah Item</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveClient" autocomplete="off">

                            <div class="px-lg-2">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('item_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-item_name">{{ __('Nama Item') }}</label>
                                        <input
                                            type="text"
                                            name="item_name"
                                            id="input-item_name"
                                            class="form-control form-control-alternative{{ $errors->has('item_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Item') }}"
                                            required
                                            autofocus
                                            wire:model="item_name">

                                        @if ($errors->has('item_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('item_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('type_of_item') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-type_of_item">{{ __('Tipe Item') }}</label>
                                        <input
                                            type="phone"
                                            name="type_of_item"
                                            id="input-type_of_item"
                                            class="form-control form-control-alternative{{ $errors->has('type_of_item') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tipe Item') }}"
                                            required
                                            autofocus
                                            wire:model="type_of_item">

                                        @if ($errors->has('type_of_item'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type_of_item') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('item_qty') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-item_qty">{{ __('Item Qty') }}</label>
                                        <input
                                            type="number"
                                            name="item_qty"
                                            id="input-item_qty"
                                            class="form-control form-control-alternative{{ $errors->has('item_qty') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Item Qty') }}"
                                            required
                                            autofocus
                                            wire:model="item_qty">

                                        @if ($errors->has('item_qty'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('item_qty') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-price">{{ __('Harga') }}</label>
                                        <input
                                            type="number"
                                            name="price"
                                            id="input-price"
                                            class="form-control form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Harga') }}"
                                            required
                                            autofocus
                                            wire:model="price">

                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('item.index') }}" class="btn btn-danger mt-2">{{ __('Batal') }}</a>
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

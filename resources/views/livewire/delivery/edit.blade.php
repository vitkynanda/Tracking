<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Pengiriman</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('delivery.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('delivery.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ubah Pengiriman</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveOrigin" autocomplete="off">  
                            @csrf
                            <div class="px-lg-2">
                                <div class="row">
                                    <div wire:ignore class="form-group{{ $errors->has('packing_list_new') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-packing_list_new">{{ __('Packing List') }}</label>
                                        <select
                                            name="packing_list_new[]"
                                            id="input-packing_list_new"
                                            class="form-control form-control-alternative{{ $errors->has('packing_list_new') ? ' is-invalid' : '' }}"
                                            required
                                            autofocus
                                            wire:model="packing_list_new"
                                            multiple>
                                            @foreach ($packings as $packing)
                                                <option value="{{$packing->packing_list_number}}"
                                                    @if (in_array($packing->packing_list_number, $packing_list_new))
                                                        selected
                                                    @endif
                                                    >{{$packing->packing_list_number}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('packing_list_new'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('packing_list_new') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('container_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-container_name">{{ __('Nama Container') }}</label>
                                        <select
                                            name="container_name"
                                            id="input-container_name"
                                            class="form-control form-control-alternative{{ $errors->has('container_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Container') }}"
                                            required
                                            autofocus
                                            wire:model="container_name">
                                            <option>Pilih Container</option>
                                            @foreach ($containers as $container)
                                                <option value="{{$container->container_name}}">{{$container->container_name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('container_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('container_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('origin_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-origin_name">{{ __('Gudang Asal') }}</label>
                                        <select
                                            name="origin_name"
                                            id="input-origin_name"
                                            class="form-control form-control-alternative{{ $errors->has('origin_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Gudang Asal') }}"
                                            required
                                            autofocus
                                            wire:model="origin_name">
                                            <option>Pilih Gudang Asal</option>
                                            @foreach ($origins as $origin)
                                                <option value="{{$origin->origin_name}}">{{$origin->origin_name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('origin_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('origin_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('destination_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-destination_name">{{ __('Gudang Tujuan') }}</label>
                                        <select
                                            name="destination_name"
                                            id="input-destination_name"
                                            class="form-control form-control-alternative{{ $errors->has('destination_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Gudang Tujuan') }}"
                                            required
                                            autofocus
                                            wire:model="destination_name">
                                            <option>Pilih Gudang Tujuan</option>
                                            @foreach ($destinations as $destination)
                                                <option value="{{$destination->destination_name}}">{{$destination->destination_name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('destination_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('destination_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group{{ $errors->has('client_name') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-client_name">{{ __('Nama Client') }}</label>
                                        <select
                                            name="client_name"
                                            id="input-client_name"
                                            class="form-control form-control-alternative{{ $errors->has('client_name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Client') }}"
                                            required
                                            autofocus
                                            wire:model="client_name">
                                            <option>Pilih Client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{$client->client_name}}">{{$client->client_name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('client_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('client_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('delivery_type') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-delivery_type">{{ __('Jenis Pengiriman') }}</label>
                                        <select
                                            name="delivery_type"
                                            id="input-delivery_type"
                                            class="form-control form-control-alternative{{ $errors->has('delivery_type') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Jenis Pengiriman') }}"
                                            required
                                            autofocus
                                            wire:model="delivery_type">
                                            <option>Pilih Jenis Pengiriman</option>
                                            <option value="1">Import</option>
                                            <option value="2">Eksport</option>
                                        </select>

                                        @if ($errors->has('delivery_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('delivery_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a href="{{ route('delivery.index') }}" class="btn btn-danger mt-2">{{ __('Batal') }}</a>
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


@push('js')
    <script>
        $(document).ready(function() {
            $('#input-packing_list_new').select2();
            $('#input-packing_list_new').on('change', function (e) {
                var data = $('#input-packing_list_new').select2("val");
                @this.set('packing_list_new', data);
            });
        });
    </script>
@endpush

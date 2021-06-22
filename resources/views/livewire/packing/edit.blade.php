<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Packing</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('packing.index') }}"><i class="fas fa-home"></i></a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('packing.index') }}" class="btn btn-sm btn-neutral">Semua Data <i class="fa fa-home fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ubah Packing</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body bg-secondary">
                        <form wire:submit.prevent="saveOrigin" autocomplete="off">

                            <div class="px-lg-2">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('packing_list_number') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-packing_list_number">{{ __('Packing List Number') }}</label>
                                        <input
                                            type="text"
                                            name="packing_list_number"
                                            id="input-packing_list_number"
                                            class="form-control form-control-alternative{{ $errors->has('packing_list_number') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Packing List Number') }}"
                                            required
                                            autofocus
                                            wire:model="packing_list_number">

                                        @if ($errors->has('packing_list_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('packing_list_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('document_upload_new') ? ' has-danger' : '' }} col-md-6 px-2 mb-2">
                                        <label class="form-control-label" for="input-document_upload_new">{{ __('Upload Dokumen') }}</label>
                                        <h6>Current File: {{$document_upload}} <button class="btn btn-sm" wire:click="downloadFile('{{$document_upload}}')"><i class="fa fa-download"></i></button></h6>
                                        <input
                                            type="file"
                                            name="document_upload_new"
                                            id="input-document_upload_new"
                                            class="form-control form-control-alternative{{ $errors->has('document_upload_new') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Upload Dokumen') }}"
                                            wire:model="document_upload_new">

                                        @if ($errors->has('document_upload_new'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('document_upload_new') }}</strong>
                                            </span>
                                        @endif
                                        
                                        <div wire:loading wire:target="document_upload_new">Uploading...</div>
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

<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Packing</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        {{-- <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li> --}}
                        {{-- <li class="breadcrumb-item"><a href="#">Container</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Indeks</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <a href="{{ route('packing.create') }}" class="btn btn-sm btn-neutral">New <i class="fa fa-plus fa-sm"></i></a>
                {{-- <a href="" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h3 class="mb-0">Packing</h3>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="d-md-flex justify-content-end">
                                    <div class="form-group mb-0">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Search" type="text" wire:model="search">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">PL Number</th>
                                    <th scope="col" class="sort" data-sort="status">Created at</th>
                                    <th scope="col">Created by</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($items as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3 bg-primary">
                                                    {{-- <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg"> --}}
                                                    <i class="fa fa-list"></i>
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{$item->packing_list_number}}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}
                                        </td>
                                        <td>
                                            <i class="fa fa-user text-primary"></i>
                                            <span class="ml-2">{{ $item->rec_usercreated }}</span>
                                        </td>
                                        <td class="text-left">
                                                <button class="btn btn-primary" wire:click="downloadFile('{{$item->document_upload}}')"><i class="fa fa-download"></i></button>
                                                <a href="{{ route('packing.edit', $item->id) }}" class="btn btn-warning">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn" wire:click="deleteOrigin({{$item->id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <div class="d-flex justify-content-end">
                            {{$items->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    @if (Session::has('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{Session::get('message')}}",
            });
        </script>
    @endif
@endpush

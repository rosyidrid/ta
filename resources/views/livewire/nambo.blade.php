<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kalog Nambo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kalog Nambo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-{{$total_stok >= 0 ? 'primary' : 'danger'}}">
                        <div class="inner">
                            <h3>{{abs($total_stok)}}</h3>
                            <p>{{$total_stok >= 0 ? 'Stok' : 'Surplus Stok'}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$total_input}}</h3>
                            <p>Input</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$total_output}}</h3>
                            <p>Output</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Nambo</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool bg-danger" data-bs-toggle="modal" data-bs-target="#destroy">
                            <i class="far fa-trash-alt"></i> Trash
                        </button>
                        <button type="button" class="btn btn-tool bg-success" data-bs-toggle="modal" data-bs-target="#import">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                        <button type="button" class="btn btn-tool bg-success" data-bs-toggle="modal" data-bs-target="#tambahstok">
                            <i class="fas fa-plus"></i> Add Stok
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($data_nambo == NULL)
                    <div class="alert alert-danger text-center">
                        {{ __('Data Empty') }}
                    </div>
                    @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" scope="row">Tanggal</th>
                                <th class="text-center" scope="row">Nama Stasiun</th>
                                <th class="text-center" scope="row">Order</th>
                                <th class="text-center" scope="row">Stok Awal</th>
                                <th class="text-center" scope="row">Input</th>
                                <th class="text-center" scope="row">Output</th>
                                <th class="text-center" scope="row">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_nambo as $data)
                            <tr>
                                <th class="text-center" scope="row">{{$data->tanggal}}</th>
                                <td class="text-center">{{$data->nama_stasiun}}</td>
                                <td class="text-center">{{$data->orders}}</td>
                                <td class="text-center">{{$data->stok_awal}}</td>
                                <td class="text-center">{{$data->input}}</td>
                                <td class="text-center">{{$data->output}}</td>
                                <td class="text-center">
                                    <a href="{{ url('kalog-nambo/edit/'.$data->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{$data->id}}"><i class="far fa-trash-alt"></i></button>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="delete{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Peringatan!</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                                    <button wire:click="delete({{$data->id}})" type="button" class="btn btn-danger" data-bs-dismiss="modal">Yakin</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>

            <!-- Modal Destroy -->
            <div class="modal fade" id="destroy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Peringatan!</h5>
                        </div>
                        <div class="modal-body text-center">
                            <p>Ini akan menghapus keseluruhan data, stok, input dan output.</p>
                            <p>Apakah anda yakin?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                            <button wire:click="destroy" type="button" class="btn btn-danger" data-bs-dismiss="modal">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahstok" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Stok</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" wire:model.defer="stok_nambo" class="form-control @error('stok_nambo') is-invalid @enderror" id="stok_nambo" aria-describedby="emailHelp">
                                @error('stok_nambo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button wire:click="addstok" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Import-->
            <div class="modal fade" id="import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Import Data</h5>
                        </div>
                        <form wire:submit.prevent="save" class="p-3" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="modal-body">
                                <label for="data">Upload file Csv</label>
                                <input type="file" wire:model="data" id="data" class="form-control" accept=".csv">
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @error('data') <span class="error">{{ $message }}</span> @enderror
                                <label for="date" class="mt-3">Tanggal Update</label>
                                <input type="date" wire:model="date" id="date" class="form-control">
                                @error('date') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button wire:click="addstok" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
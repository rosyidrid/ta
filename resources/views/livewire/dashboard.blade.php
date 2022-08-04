<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
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
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$data->total_order}}</h3>

                            <p>Total Order</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->

                    <div class="small-box bg-{{$data->stok_awn >= 0 ? 'success' : 'danger'}}">
                        <div class="inner">
                            <h3>{{abs($data->stok_awn)}}</h3>

                            <p>{{$data->stok_awn >= 0 ? 'Stok Awn' : 'Surplus Stok Awn'}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('Awn')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-{{$data->stok_nambo >= 0 ? 'warning' : 'danger'}}">
                        <div class="inner">
                            <h3>{{abs($data->stok_nambo)}}</h3>

                            <p>{{$data->stok_nambo >= 0 ? 'Stok Nambo' : 'Surplus Stok Nambo'}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('Nambo')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-{{$data->stok >= 0 ? 'secondary' : 'danger'}}">
                        <div class="inner">
                            <h3>{{abs($data->stok)}}</h3>

                            <p>{{$data->stok >= 0 ? 'Total Stok' : 'Surplus Total Stok'}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Set Data</h3>
                </div>
                <div class="card-body">
                    @if($hasil == NULL)
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
                                <th class="text-center" scope="row">Input</th>
                                <th class="text-center" scope="row">Output</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasil as $values => $data)
                            @php
                            $counter = 0
                            @endphp
                            @foreach($data as $i => $j)
                            @foreach($j as $k)
                            <tr>
                                @if($counter == 0)
                                <th class="text-center align-middle" rowspan="{{count($j)}}">{{$counter == 0 ? key($data) : ''}}</th>
                                @endif
                                <td class="text-center">{{$k['nama_stasiun']}}</td>
                                <td class="text-center">{{$k['orders']}}</td>
                                <td class="text-center">{{$k['input']}}</td>
                                <td class="text-center">{{$k['output']}}</td>
                            </tr>
                            @php
                            $counter++
                            @endphp
                            @endforeach
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div><!-- /.card-body -->
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
    </section>
    <!-- /.content -->
</div>
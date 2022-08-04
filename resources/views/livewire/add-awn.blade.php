<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Add Kalog Awn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('Awn')}}">Kalog Awn</a></li>
                        <li class="breadcrumb-item active">Add Kalog Awn</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-sm">
            <!-- /.card -->
            <div class="card">
                <div class="card-body">
                    @if (session()->has('add-awn'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('add-awn') }}
                    </div>
                    @elseif (session()->has('alert'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ session('alert') }}
                    </div>
                    @endif
                    <form wire:submit.prevent="addawn">
                        <div class="mb-3">
                            <label for="nama_stasiun" class="form-label">Nama Stasiun</label>
                            <input type="text" wire:model="nama_stasiun" class="form-control @error('nama_stasiun') is-invalid @enderror" id="nama_stasiun" aria-describedby="emailHelp">
                            @error('nama_stasiun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input" class="form-label">Input</label>
                            <input type="text" wire:model="input" class="form-control form-control @error('input') is-invalid @enderror" id="input">
                            @error('input') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="output" class="form-label">Output</label>
                            <input type="text" wire:model="output" class="form-control form-control @error('output') is-invalid @enderror" id="output" aria-describedby="emailHelp">
                            @error('output') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Data</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
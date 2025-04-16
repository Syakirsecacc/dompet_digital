<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="desc" content="Best Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:desc" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">

    <!-- Title -->
    <title>Dompet Digital</title>

    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('template/assets/fonts/bootstrap/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/main.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

</head>

<body style="overflow: hidden;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                    <div class="d-flex flex-column align-items-end">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                <br><br>
                        <div class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                
                @if (Auth::user()->role == 'siswa')
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">

                                <div class="col">
                                    <div class="">
                                        <p class="">Balance : </p>
                                        <h4 class="card-text"> {{ ($saldo) }}</h4>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-warning px-5" data-bs-target="#formwithdraw" data-bs-toggle="modal">Withdraw</button>
                                    <button type="button" class="btn btn-success px-5" data-bs-target="#formTopUp" data-bs-toggle="modal">Top Up</button>
                                    <button type="button" class="btn btn-warning px-5" data-bs-target="#formTransfer" data-bs-toggle="modal">Transfer</button>


                                    <!-- Modal -->
                                    <form action="{{ route('topUp') }}" method="post">
                                        @csrf

                                        <div class="modal fade" id="formTopUp" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter the Top Up
                                                            nominal</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="number" name="credit" id=""
                                                                class="form-control" min="10000" value="10000">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Top Up Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Modal Tarik Tunai -->
                                    <form action="{{ route('withdraw') }}" method="post">
                                        @csrf

                                        <div class="modal fade" id="formwithdraw" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="number" name="debit" id=""
                                                                class="form-control" min="10000" value="10000">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Withdraw Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Modal Transfer -->
                                        <form action="{{ route('transfer') }}" method="post">
                                            @csrf
                                            <div class="modal fade" id="formTransfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Transfer Saldo</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="recipient_id" class="form-label">Pilih Penerima</label>
                                                                <select name="recipient_id" id="recipient_id" class="form-control" required>
                                                                        @foreach($users as $user)
                                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="amount" class="form-label">Jumlah Transfer</label>
                                                                <input type="number" name="amount" id="amount" class="form-control" min="10000" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Transfer Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>     
                                    </div>
                                    </div>
                                    </div>
                                 </div>                

                                    <div class="card bg-white shadow-sm border-0">
                                        <div class="card-header border-0">
                                            Mutasi Transaction
                                        </div>

                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach ($mutasi as $data)
                                                    <li class="list-group-item">
                                                        <div class="d-flex  justify-content-between align-items-center">
                                                            <div>
                                                                @if ($data->credit)
                                                                    <span class="text-success fw-bold">Credit : </span>Rp
                                                                    {{ ($data->credit) }}
                                                                @else
                                                                    <span class="text-danger fw-bold">Debit : </span>Rp
                                                                    {{ ($data->debit) }}
                                                                @endif
                                                            </div>
                                                            <div class="">
                                                                <span class="badge rounded-pill border border-warning text-warning">{{$data->status == 'process' ? 'PROSES' : ''}}</span>
                                                                @if ($data->status == 'process')

                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{ $data->description }}
                                                        <p class="text-grey">Date : {{ $data->created_at }}</p>

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->role == 'bank')
                    <div class="">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
    
                                    <div class="col">
                                        <div class="">
                                            <p class="">Balance : </p>
                                            <h4 class="card-text"> {{ ($saldo) }}</h4>
                                        </div>
                                    </div>
                                    <div class="col text-end">
                                        <button type="button" class="btn btn-warning px-5" data-bs-target="#formWithdraw" data-bs-toggle="modal">Withdraw</button>
                                        <button type="button" class="btn btn-success px-5" data-bs-target="#formTopUp" data-bs-toggle="modal">Top Up</button>
                                        <button type="button" class="btn btn-warning px-5" data-bs-target="#formTransfer" data-bs-toggle="modal">Transfer</button>
                                        <!-- Modal -->
                                        <form action="{{ route('topUp') }}" method="post">
                                            @csrf
    
                                            <div class="modal fade" id="formTopUp" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Enter the Top Up
                                                                nominal</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="number" name="credit" id=""
                                                                    class="form-control" min="10000" value="10000">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Top Up Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
    
                                        <!-- Modal Tarik Tunai -->
                                        <form action="{{ route('withdraw') }}" method="post">
                                            @csrf
                                            <div class="modal fade" id="formWithdraw" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <input type="number" name="debit" id=""
                                                                    class="form-control" min="10000" value="10000">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Withdraw Now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                       

<!-- Form Transfer -->
<form action="{{ route('transfer') }}" method="POST">
    @csrf
    <div class="modal fade" id="formTransfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transfer Saldo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Pilih Penerima -->
                    <div class="mb-3">
                        <label for="recipient_id" class="form-label">Pilih Penerima</label>
                        <select name="recipient_id" id="recipient_id" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Nasabah --</option>
                            
                        </select>
                    </div>

                    <!-- Jumlah Transfer -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Transfer</label>
                        <input type="number" name="amount" id="amount" class="form-control" min="10000" required>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer Now</button>
                </div>
            </div>
        </div>
    </div>
</form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-4 col-sm-6 col-12">
                                <div class="stats-tile">
                                    <div class="sale-icon shade-red">
                                        <i class="bi bi-pie-chart"></i>
                                    </div>
                                    <div class="sale-details">
                                        <h3 class="text-red">{{ $allMutasi }}</h3>
                                    <p>Mutasi Transaction</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-sm-6 col-12">
                                <div class="stats-tile">
                                    <div class="sale-icon shade-blue">
                                        <i class="bi bi-emoji-smile"></i>
                                    </div>
                                    <div class="sale-details">
                                        <h3 class="text-blue">{{ $nasabah }}</h3>
                                        <p>Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xxl-7  col-sm-12 col-12">

                                <div class="card bg-white shadow-sm border-0 mb-4">
                                    <div class="card-header border-0">
                                        Request Transaction Customer
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">

                                                @foreach ($request_payment as $request)
                                                    <form action="{{ route('acceptRequest') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="wallet_id" value="{{ $request->id }}">
                                                        <div class="card bg-white shadow-sm border-0 mb-3">
                                                            <div class="card-header border-0">
                                                                {{ $request->user->name }}
                                                            </div>
                                                            <div class="card-body d-flex justify-content-between">

                                                                <div class="col my-auto">
                                                                    @if ($request->credit)
                                                                        <span class="text-green fw-bold">Top Up :</span> {{ ($request->credit) }}
                                                                    @elseif ($request->debit)
                                                                    <span class="text-red fw-bold">Withdraw :</span> {{ ($request->debit) }}
                                                                    @endif
                                                                    <div class="text-secondary">
                                                                        <p>{{ $request->created_at }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col text-end">
                                                                    <button type="submit" class="btn btn-primary">Accept Request</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xxl-5  col-sm-12">
                                <div class="card bg-white shadow-sm border-0">
                                    <div class="card-header border-0">
                                        History Transaction
                                    </div>

                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($mutasi as $data)
                                                <li class="list-group-item">
                                                    <div class="d-flex  justify-content-between align-items-center">
                                                        <div>
                                                            @if ($data->credit)
                                                                <span class="text-success fw-bold">Credit : </span>Rp
                                                                {{ ($data->credit) }}
                                                            @else
                                                                <span class="text-danger fw-bold">Debit : </span>Rp
                                                                {{ ($data->debit) }}
                                                            @endif

                                                        </div>

                                                    </div>
                                                    Name : {{ $data->user->name }}
                                                    <p class="text-grey">{{ $data->description }}</p>
                                                    <p class="text-grey">Date : {{ $data->created_at }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Row end -->
                    </div>
                @endif

                
                @if (Auth::user()->role == 'admin')
                  
                <div class="col-xxl-4 col-sm-6 col-12">        
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-sm-6 col-12">
                            <div class="stats-tile">
                                <div class="sale-icon shade-blue">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="sale-details">
                                    <h3 class="text-blue">{{ $user }}</h3>
                                    <p>User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-7 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <div class="ms-2">User List</div>
                                    </div>
                                    <a href="{{ route('user.create') }}" class="btn btn-primary ms-auto">
                                        <i class="bi bi-plus"></i> Add
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table v-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userAll as $key => $user)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td class="p-auto d-flex justify-content-roundly " >
                                                            <a href="{{ route('user.edit', $user) }}" class="btn btn-warning bi bi-pencil m-1"></a>
                                                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger bi bi-trash m-1" onclick="return confirm('Apakah anda yakin hapus {{ $user->name }}')"></button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xxl-5  col-sm-12">
                            <div class="card bg-white shadow-sm border-0">
                                <div class="card-header border-0">
                                    History Transaction
                                </div>

                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($mutasi as $data)
                                            <li class="list-group-item">
                                                <div class="d-flex  justify-content-between align-items-center">
                                                    <div>
                                                        @if ($data->credit)
                                                            <span class="text-success fw-bold">Credit : </span>Rp
                                                            {{ ($data->credit) }}
                                                        @else
                                                            <span class="text-danger fw-bold">Debit : </span>Rp
                                                            {{ ($data->debit) }}
                                                        @endif

                                                    </div>
                                                </div>
                                                Name : {{ $data->user->name }}
                                                <p class="text-grey">{{ $data->description }}</p>
                                                <p class="text-grey">Date : {{ $data->created_at }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

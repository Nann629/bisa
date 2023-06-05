@extends('layout.main')

@section('title', 'Subject')

@section('konten')


    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>@yield('title')</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="beranda">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
                {{-- star tambah data --}}
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="sub-add" class="btn btn-primary" data-target="#tambah" role="button"
                        data-toggle="modal">Tambah</a>
                </div>
                @if (Session::has('status'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form action="/sub" method="post">
                    <div id="tambah" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-haeder">
                                    <div class="card-header">
                                        <h4 class="modal-title"> Tambah Data </h4>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Keterangan</label>
                                            <input type="type" class="form-control" name='name' id="name"
                                                required>
                                        </div>
                                        <div class="modal-fooder">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- finis --}}
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">#</th>
                        <th>Keterangan</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($sub as $item)
                        <tr>
                            @csrf
                            <td class="table-plus">{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    @if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                                    @else
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            {{-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> --}}
                                            {{-- <a class="dropdown-item" role="button" data-toggle="model" href="kriteria-edit"><i class="dw dw-edit2"></i> Edit</a> --}}
                                            <a class="dropdown-item" href="/kriteria-edit/{{ $item->id }}"
                                                data-target="#edit{{ $item->id }}" role="button" data-toggle="modal"><i
                                                    class="dw dw-edit2"></i>
                                                Edit</a>
                                            {{-- </div> --}}
                                            @if (Auth::user()->role_id == 1)
                                                <a class="dropdown-item" href="kriteria-delete/{{ $item->id }}"
                                                    data-target="#hapus{{ $item->id }}" role="button"
                                                    data-toggle="modal"><i class="dw dw-delete-3"></i>
                                                    Hapus</a>
                                        </div>
                                    @endif
                    @endif
        </div>
        </td>
        </tr>

        {{-- edit --}}
        <div class="row">
            <form action="/sub-edit/{{ $item->id }}" method="post">
                <div id="edit{{ $item->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-haeder">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="form-group">
                                    <h4 class="modal-title"> Edit Data </h4>
                                </div>
                            </div>
                            @csrf
                            @method('PUT')
                            <form action="/sub-edit/{{ $item->id }}" method="get" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="from-group">
                                        <label class="control-label" for="name">Code</label>
                                        <input type="text" class="form-control" name='name' id="name"
                                            value="{{ $item->name }}" required>
                                    </div>
                                    {{-- <div class="form-group">
                                                        <label class="control-label" for="name">Keterangan</label>
                                                        <input type="type" class="form-control" name='deskripsi'
                                                            id="deskripsi" value="{{ $item->deskripsi }}" required>
                                                    </div> --}}
                                    <br>
                                    <div class="modal-fooder">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Hapus --}}
        <div class="row">
            <div id="hapus{{ $item->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="padding: 20px">
                        <div class="modal-haeder">
                            <div class="from-group">
                                <h4 class="modal-title">
                                    <h2>Hapus Data</h2>
                                </h4>
                            </div>
                        </div>
                        <div class="modal-body">
                            Yakin Hapus Data ?
                        </div>
                        <div class="modal-fooder">
                            <form action="/sub-delete/{{ $item->id }}" style="display: inline-block"
                                method="delete">

                                <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                            <a href="/sub" class="btn btn-primary">Cencel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>




@endsection

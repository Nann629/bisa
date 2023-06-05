@extends('layout.main')

@section('title', 'Dokument')

@section('konten')

    {{-- {{ $dokument }} --}}
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
                    <a href="dokument-add" class="btn btn-primary" data-target="#tambah" role="button"
                        data-toggle="modal">Tambah</a>
                </div>
                @if (Session::has('status'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form action="/dokument" method="post">
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
                                        <div class="from-group">
                                            <label class="control-label" for="name">File</label>
                                            <input type="file" class="form-control" accept="application/pdf"
                                                name='image' id="image" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label" for="name">Kriteria</label>
                                            {{-- <input type="type" class="form-control" name='deskripsi' id="deskripsi" required> --}}
                                            <select name="kriterias_id" id="kriteria" class="form-control" required>
                                                <option value="">Select One</option>
                                                @foreach ($kriterias as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="name">Sub</label>
                                            {{-- <input type="type" class="form-control" name='deskripsi' id="deskripsi" required> --}}
                                            <select name="subs_id" id="sub" class="form-control" required>
                                                <option value="">Select One</option>
                                                @foreach ($subs as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
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
                        <th>File</th>
                        <th>Kriteria</th>
                        <th>Sub</th>

                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokumentlist as $item)
                        <tr>
                            @csrf
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>{{ $item->image }}</td>
                            <td>{{ $item->kriteria['name'] }}</td>
                            <td>{{ $item->sub['name'] }}</td>
                            <td>
                                <button class="btn" data-target="#view{{ $item->id }}" data-toggle="modal"><i
                                        class="dw dw-eye"></i></button>
                                <button class="btn" data-target="#edit{{ $item->id }}" data-toggle="modal"><i
                                        class="dw dw-edit2"></i></button>
                                <button class="btn" data-target="#hapus{{ $item->id }}" data-toggle="modal"><i
                                        class="dw dw-delete-3"></i></button>
                                <div id="view{{ $item->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="padding: 20px">
                                            <div class="modal-haeder">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="form-group">
                                                    <h4 class="modal-title"> Tampilan Data</h4>
                                                </div>
                                            </div>
                                            @csrf
                                            @method('PUT')
                                            <form action="/dokument-edit/{{ $item->id }}" method="get"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="from-group">
                                                        <label class="control-label" for="name">File</label>
                                                        <input type="file" class="form-control" name='image'
                                                            id="image" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Kriteria</label>
                                                        {{-- <input type="type" class="form-control" name='deskripsi' id="deskripsi" required> --}}
                                                        <select name="kriterias_id" id="kriteria" class="form-control"
                                                            required>
                                                            <option value="">Select One</option>
                                                            @foreach ($kriterias as $kriteria)
                                                                <option value="{{ $kriteria->id }}">
                                                                    {{ $kriteria->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Sub</label>
                                                        {{-- <input type="type" class="form-control" name='deskripsi' id="deskripsi" required> --}}
                                                        <select name="subs_id" id="sub" class="form-control"
                                                            required>
                                                            <option value="">Select One</option>
                                                            @foreach ($subs as $sub)
                                                                <option value="{{ $sub->id }}">
                                                                    {{ $sub->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-fooder">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit{{ $item->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="padding: 20px">
                                            <div class="modal-haeder">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <div class="form-group">
                                                    <h4 class="modal-title"> Edit Data /{{ $item->id }} </h4>
                                                </div>
                                            </div>
                                            @csrf
                                            @method('PUT')
                                            <form action="/dokument-edit/{{ $item->id }}" method="get"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="from-group">
                                                        <label class="control-label" for="name">File</label>
                                                        <input type="file" class="form-control" name='image'
                                                            id="image" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Kriteria</label>
                                                        <select name="kriterias_id" id="kriteria" class="form-control"
                                                            required>
                                                            <option value="">Select One</option>
                                                            @foreach ($kriterias as $kriteria)
                                                                <option value="{{ $kriteria->id }}">
                                                                    {{ $kriteria->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="name">Sub</label>
                                                        <select name="subs_id" id="sub" class="form-control"
                                                            required>
                                                            <option value="">Select One</option>
                                                            @foreach ($subs as $sub)
                                                                <option value="{{ $sub->id }}">
                                                                    {{ $sub->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-fooder">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                <form action="/dokument-delete/{{ $item->id }}"
                                                    style="display: inline-block" method="delete">

                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                </form>
                                                <a href="/dokument" class="btn btn-primary">Cencel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                @if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2)
                                @else
                                    {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> --}}

                                    {{-- <a class="dropdown-item" role="button" data-toggle="model" href="kriteria-edit"><i class="dw dw-edit2"></i> Edit</a> --}}
                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                @endif
                            </td>

                            <div class="row">

                            </div>

                            {{-- <div class="row">

                            </div> --}}

                            {{-- Hapus --}}
                            <div class="row">

                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection





{{-- edit --}}

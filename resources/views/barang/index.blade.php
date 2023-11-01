@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addNewModal">
                        Add New
                    </button>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Nama barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($result as $res)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $res->jenisBarang->nama_jenis }}</td>
                                    <td>{{ $res->nama_barang }}</td>
                                    <td>{{ $res->harga }}</td>
                                    <td>{{ $res->stok }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $res->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $res->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="jenis_id" class="col-sm-3 col-form-label">Pilih Jenis</label>
                            <div class="col-sm-9">
                                <select name="jenis_id" id="jenis_id" class="form-control" required>
                                    <option value="">--- Pilih Jenis ---</option>
                                    @foreach ($jenisBarang as $jb)
                                        <option value="{{ $jb->id }}">{{ $jb->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                    placeholder="Masukkan nama barang" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="harga" id="harga"
                                    placeholder="Masukkan harga" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="stok" id="stok"
                                    placeholder="Masukkan stok" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($result as $res)
        {{-- Modal Edit --}}
        <div class="modal fade" id="editModal{{ $res->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('barang.update', ['id' => $res->id]) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="jenis_id" class="col-sm-3 col-form-label">Pilih Jenis</label>
                                <div class="col-sm-9">
                                    <select name="jenis_id" id="jenis_id" class="form-control" required>
                                        <option value="">--- Pilih Jenis ---</option>
                                        @foreach ($jenisBarang as $jb)
                                            <option value="{{ $jb->id }}"
                                                {{ $res->jenis_id == $jb->id ? 'selected' : '' }}>{{ $jb->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                        placeholder="Masukkan nama barang" autocomplete="off"
                                        value="{{ $res->nama_barang }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="harga" id="harga"
                                        placeholder="Masukkan harga" autocomplete="off" value="{{ $res->harga }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="stok" id="stok"
                                        placeholder="Masukkan stok" autocomplete="off" value="{{ $res->stok }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($result as $res)
        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal{{ $res->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{ route('barang.destroy', ['id' => $res->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

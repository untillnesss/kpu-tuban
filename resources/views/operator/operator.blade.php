@extends('lay.lay')

@section('title','Operator')


@section('main')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-end align-item-center">
        <button class="btn btn-primary btn-sm" id="btnModalAddOperator">TAMBAH OPERATOR</button>
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalOperator">TAMBAH OPERATOR</button> --}}
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table" id="tableOperator">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>TPS</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan/Desa</th>
                        <th>Email</th>
                        <th>Nomer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalOperator">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Operator</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form> --}}
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama ...">

                </div>
                <div class="form-group">
                    <label for="tps">TPS</label>
                    <input type="number" class="form-control" id="tps" placeholder="Masukkan nomer TPS">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kec">Kecamatan</label>
                        <select class="custom-select" id="kec">
                            <option disabled selected value="0">Loading...</option>
                        </select>
                        <input type="hidden" id="kectext">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ds">Kelurahan/Desa</label>
                        <select class="custom-select" id="kel">
                            <option disabled selected value="0">Pilih kecamatan terlebih dahulu</option>
                        </select>
                        <input type="hidden" id="keltext">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan email ...">
                </div>
                <div class="form-row" id="passwordField">
                    <div class="form-group col-md-6">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" placeholder="Masukkan password ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="passKon">Konfirmasi password</label>
                        <input type="password" class="form-control" id="passKon"
                            placeholder="Masukkan ulang password ...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Nomer HP.</label>
                    <input type="number" class="form-control" id="nomer" placeholder="Masukkan nomer HP ...">
                </div>
                <button class="btn btn-primary" id="btnAddOperator">TAMBAH</button>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>

@endsection

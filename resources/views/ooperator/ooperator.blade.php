@extends('lay.lay')

@section('title', 'Operator - Dashboard')

@section('main')
{{-- <div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            Isi Data Di Bawah Terlebih Dahulu !
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            {{-- LOADER --}}
            <div class="loading-dimmer dimmer-over" id="over">
                <div class="spinner-grow text-warning" style="width: 5rem; height: 5rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            {{-- TAHAP SATU --}}
            <div class="card">
                <div class="card-header p-0"
                    id="tahapSatu" data-toggle="collapse" data-target="#tahapSatuCollapse" aria-expanded="true"
                    aria-controls="tahapSatuCollapse">
                    <h2 class="mb-0">
                        <button class="btn remove-outline" type="button">
                            Tahap Satu - <b>INFO TPS</b> (07:00 - 12:59)
                        </button>
                    </h2>
                </div>
                <div id="tahapSatuCollapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="loading-dimmer-over" id="overSatu">
                        <div class="d-flex align-items-center  text-white" style="flex-direction: column">
                            <i class="fas fa-stopwatch fa-4x"></i>
                            <p>-- Tahap satu terbuka pada jam 07:00 WIB --</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-12">
                                <label for="">Jumlah DPT (Daftar Pemilih Tetap)</label>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-venus"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Laki-laki" id="lk">
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-mars"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Perempuan" id="pr">
                                </div>
                            </div>
                            <div class="form-group col -12col-sm-12 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-equals"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Jumlah" readonly disabled
                                        id="jumlahGender">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Kertas Suara</label>
                                <input type="text" class="form-control" placeholder="Jumlah kertas suara" id="kertas">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Bilik Suara</label>
                                <input type="text" class="form-control" placeholder="Jumlah bilik suara" id="bilik">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Alas Coblos</label>
                                <input type="text" class="form-control" placeholder="Jumlah alas coblos" id="alas">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Tinta</label>
                                <input type="text" class="form-control" placeholder="Jumlah tinta" id="tinta">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <div class="d-flex d-sm-block" style="flex-direction:column">
                                    <small>*(Data bersifat permanen) Pastikan data yang dimasukkan sudah benar</small>
                                    <button class="btn btn-primary mt-2 mt-sm-0" id="saveInfoTps">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TAHAP DUA --}}
            <div class="card">
                <div class="card-header p-0"
                    id="tahapDua" data-toggle="collapse" data-target="#tahapDuaCollapse" aria-expanded="true"
                    aria-controls="tahapDuaCollapse">
                    <h2 class="mb-0">
                        <button class="btn remove-outline" type="button">
                            Tahap Dua - <b>DATA PEMILIH</b> (13:00 - 13:59)
                        </button>
                    </h2>
                </div>
                <div id="tahapDuaCollapse" class="collapse" aria-labelledby="tahapDua" data-parent="#accordionExample">
                    <div class="loading-dimmer-over" id="overDua">
                        <div class="d-flex align-items-center  text-white" style="flex-direction: column">
                            <i class="fas fa-stopwatch fa-4x"></i>
                            <p>-- Tahap dua terbuka pada jam 13:00 WIB --</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-12">
                                <label for="">Pemilih dalam DPT</label>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-venus"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Laki-laki">
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-mars"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Perempuan">
                                </div>
                            </div>
                            <div class="form-group col -12col-sm-12 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-equals"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Jumlah" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="">Pemilih dalam DPPH</label>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-venus"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Laki-laki">
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-mars"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Perempuan">
                                </div>
                            </div>
                            <div class="form-group col -12col-sm-12 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-equals"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Jumlah" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="">Pemilih dalam DPTB</label>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-venus"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Laki-laki">
                                </div>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-mars"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Perempuan">
                                </div>
                            </div>
                            <div class="form-group col -12col-sm-12 col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-equals"></i></div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Jumlah" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <div class="d-flex d-sm-block" style="flex-direction:column">
                                    <small>*(Data bersifat permanen) Pastikan data yang dimasukkan sudah benar</small>
                                    <button class="btn btn-primary mt-2 mt-sm-0" id="saveInfoTps">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TAHAP TIGA --}}
            <div class="card">
                <div class="card-header p-0"
                    id="tahapTiga" data-toggle="collapse" data-target="#tahapTigaCollapse" aria-expanded="true"
                    aria-controls="tahapTigaCollapse">
                    <h2 class="mb-0">
                        <button class="btn remove-outline" type="button">
                            Tahap Tiga - <b>HASIL SURAT PERHITUNGAN</b> (14:00 - Selesai)
                        </button>
                    </h2>
                </div>
                <div id="tahapTigaCollapse" class="collapse" aria-labelledby="tahapTiga" data-parent="#accordionExample">
                    <div class="loading-dimmer-over" id="overDua">
                        <div class="d-flex align-items-center  text-white" style="flex-direction: column">
                            <i class="fas fa-stopwatch fa-4x"></i>
                            <p>-- Tahap tiga terbuka pada jam 14:00 WIB --</p>
                        </div>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat ipsam, neque labore doloribus error nobis obcaecati, tempora corporis placeat, cum fugit amet. Minus illo quod exercitationem sequi voluptatum reprehenderit quo!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('lay.lay')

@section('title', 'Operator - Dashboard')

@section('main')
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            Isi Data Di Bawah Terlebih Dahulu !
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header p-0" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <h2 class="mb-0">
                        <button class="btn" type="button">
                            Tahap Satu - Info TPS (00:07 - 12:59)
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
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
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Kertas Suara</label>
                                <input type="text" class="form-control" placeholder="Jumlah kertas suara">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Bilik Suara</label>
                                <input type="text" class="form-control" placeholder="Jumlah bilik suara">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Alas Coblos</label>
                                <input type="text" class="form-control" placeholder="Jumlah alas coblos">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="">Tinta</label>
                                <input type="text" class="form-control" placeholder="Jumlah tinta">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <h2 class="mb-0">
                        <button class="btn" type="button">
                            Collapsible Group Item #1s
                        </button>
                    </h2>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                        anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                        occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard
                        of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

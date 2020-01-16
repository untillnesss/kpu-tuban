@extends('lay.lay')

@section('title','Calon Bupati')


@section('main')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-end align-item-center">
        <button class="btn btn-primary btn-sm" id="btnModalCalon" data-backdrop="static" data-keyboard="false">TAMBAH
            CALON BUPATI</button>
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalOperator">TAMBAH OPERATOR</button> --}}
    </div>
</div>
<div class="row" id="calonField">
    <div class="col-12"><div class="alert alert-info">Loading ...</div></div>
</div>

<div class="modal fade" id="modalCalon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Calon Bupati</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="card mt-3">
                    <div class="card-header text-center">
                        <h3 id="addNoUrut">NOMER URUT</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6 col-12">
                            <div class="card text-center" style="height: 100%">
                                <div class="card-body">
                                    <h3>BUPATI</h3>
                                    <hr>
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; justify-content: center">
                                        <img src="{{asset('img/poto.png')}}" alt="" class="img-thumbnail"
                                            style="border-radius: 50%" height="200" width="200" id="imgBupati">
                                        <button class="btn btn-small btn-primary mt-4" data-toggle="modal"
                                            data-target="#modalFotoBupati" data-backdrop="static" data-keyboard="false"
                                            id="ubahFotoBupati">UBAH
                                            FOTO</button>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Masukkan nama ..."
                                            id="namaBupati">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                            <div class="card text-center" style="height: 100%">
                                <div class="card-body">
                                    <h3>WAKIL BUPATI</h3>
                                    <hr>
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; justify-content: center">
                                        <img src="{{asset('img/poto.png')}}" alt="" class="img-thumbnail"
                                            style="border-radius: 50%" height="200" width="200" id="imgWakil">
                                        <button class="btn btn-small btn-primary mt-4" data-toggle="modal"
                                            data-target="#modalFotoBupati" data-backdrop="static" data-keyboard="false"
                                            id="ubahFotoWakil">UBAH
                                            FOTO</button>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Masukkan nama ..."
                                            id="namaWakil">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalCalonBupati">Close</button>
                <button type="button" class="btn btn-primary" id="saveCalon">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFotoBupati">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputImg">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                </div>
                <button class="btn btn-danger btn-small ml-3" data-dismiss="modal"
                    onclick="$('#modalBodyFotoBupati').slideUp()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="modalBodyFotoBupati" style="display: none">
                <div style="width:100%; height: 400px">
                    <img src="/img/potos.jpg" alt="" id="imgCrop" style="max-width:100% !important; display: block">
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between">

                    <div class="btn-group mt-3">
                        <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Putar ke kiri"
                            id="rotateLeft">
                            <i class="fas fa-undo-alt"></i>
                        </button>
                        <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Reset gambar"
                            id="reset">
                            <i class="fas fa-sync"></i>
                        </button>
                        <button class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                            title="Putar ke kanan" id="rotateRight">
                            <i class="fas fa-redo-alt"></i>
                        </button>
                    </div>
                    <div class="btn-group mt-3">
                        <button class="btn btn-success" id="getCropedImg">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

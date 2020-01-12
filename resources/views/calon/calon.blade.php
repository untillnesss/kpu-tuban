@extends('lay.lay')

@section('title','Calon Bupati')


@section('main')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-end align-item-center">
        <button class="btn btn-primary btn-sm" id="btnModalAddOperator">TAMBAH CALON BUPATI</button>
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalOperator">TAMBAH OPERATOR</button> --}}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="alert alert-danger">Tidak ada calon bupati ! Silahkan tambahkan beberapa.</div>
    </div>
    @for ($i = 1; $i < 5; $i++) <div class=" col-xl-6 col-12">
        <div class="card mt-3">
            <div class="card-header text-center">
                <h1>{{$i}}</h1>
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <div class="card text-center" style="height: 100%">
                        <div class="card-body">
                            <h3>BUPATI</h3>
                            <hr>
                            <img src="{{asset('img/poto.jpg')}}" alt="" class="img-thumbnail" style="border-radius: 50%"
                                height="200" width="200">
                        </div>
                        <div class="card-footer">
                            <small>
                                Muhammad Abdullah Sa'id, S.Kom.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3>WAKIL BUPATI</h3>
                            <hr>
                            <img src="{{asset('img/poto.jpg')}}" alt="" class="img-thumbnail" style="border-radius: 50%"
                                height="200" width="200">
                        </div>
                        <div class="card-footer">
                            <small>
                                Muhammad Abdullah Sa'id, S.Kom.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endfor
</div>

@endsection

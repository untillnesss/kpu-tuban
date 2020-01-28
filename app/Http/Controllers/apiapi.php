<?php

namespace App\Http\Controllers;

use App\tcalon;
use App\tinfotps;
use App\toperator;
use App\User;
use Auth;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Session;

class apiapi extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $route = $request->url();
            $action = explode('/api/api/', $route);
            if ($action[1] != 'dologin') {
                if (Session::has('user') == false) {
                    return abort(401);
                }
            }
            return $next($request);
        });
    }

    public function dologin(Request $a)
    {
        if (Auth::attempt(['email' => $a->email, 'password' => $a->pass])) {
            Session::put('user', Auth::user());
            Session::put('lvl', 'admin');

            return returnjson('admin');
        } else {
            $ope = toperator::where([
                'email' => $a->email,
            ])->get();

            if ($ope->count() > 0) {

                if (Hash::check($a->pass, $ope[0]->pass)) {
                    Session::put('user', $ope[0]);
                    Session::put('lvl', 'ope');

                    return returnjson('ope');
                }
            }
        }
        return returnjson(false);
    }

    public function addoperator(Request $a)
    {
        $state = toperator::where(['kec' => $a->kec, 'kel' => $a->kel])->count();
        if ($state > 0) {
            $cek = toperator::where(['kec' => $a->kec, 'kel' => $a->kel, 'tps' => $a->tps])->count();
            if ($cek > 0) {
                return returnJson('tps');
            }
        }

        $cek = User::where('email', $a->email)->count();
        if ($cek > 0) {
            return returnJson('x');
        }

        $cek = toperator::where('email', $a->email)->count();
        if ($cek > 0) {
            return returnJson('x');
        }

        $cek = toperator::where('nomer', $a->nomer)->count();
        if ($cek > 0) {
            return returnJson('xx');
        }

        toperator::create([
            'name' => $a->nama,
            'tps' => $a->tps,
            'kec' => $a->kec,
            'kel' => $a->kel,
            'email' => $a->email,
            'pass' => Hash::make($a->pass),
            'kectext' => $a->kectext,
            'keltext' => $a->keltext,
            'nomer' => $a->nomer,
        ]);

        return returnJson('200');
    }

    public function getoperator()
    {
        return DataTables::of(toperator::select('id', 'name', 'tps', 'kectext', 'keltext', 'email', 'nomer')->get())->make();
    }

    public function getoperatordetail(toperator $id)
    {
        return $id;
    }

    public function deleteoperator(Request $a)
    {
        toperator::destroy($a->id);
    }

    public function updateoperator(Request $a)
    {
        if ($a->isChange == 'true') {
            $cek = User::where('email', $a->email)->count();
            if ($cek > 0) {
                return returnJson('x');
            } else {
                $cek = toperator::where('email', $a->email)->count();
                if ($cek > 0) {
                    return returnJson('x');
                }
            }
        }

        if ($a->isChangeNomer == 'true') {
            $cek = toperator::where('nomer', $a->nomer)->count();
            if ($cek > 0) {
                return returnJson('xx');
            }
        }

        if ($a->isChangeTps == 'true') {
            $state = toperator::where(['kec' => $a->kec, 'kel' => $a->kel])->count();
            if ($state > 0) {
                $cek = toperator::where(['kec' => $a->kec, 'kel' => $a->kel, 'tps' => $a->tps])->count();
                if ($cek > 0) {
                    return returnJson('tps');
                }
            }
        }

        toperator::where('id', $a->id)->update([
            'name' => $a->nama,
            'tps' => $a->tps,
            'kec' => $a->kec,
            'kel' => $a->kel,
            'kectext' => $a->kectext,
            'keltext' => $a->keltext,
            'email' => $a->email,
            'nomer' => $a->nomer,
        ]);

        return returnjson('200');
        // dd($a);
    }

    public function decodeImg($src, $sufix)
    {
        if ($src == '/img/poto.png') {
            return $src;
        }

        $parse = $src;
        $exparse = explode(',', $parse);
        $exparse = base64_decode($exparse[1]);
        $imBup = imageCreateFromString($exparse);

        $namaFile = time() . $sufix;

        $img_file = 'img/calon/' . $namaFile . '.png';
        imagepng($imBup, $img_file, 0);

        return '/' . $img_file;
    }

    public function addcalon(Request $a)
    {
        $pathFotoBupati = $this->decodeImg($a->imgBupati, '_bupati');
        $pathFotoWakil = $this->decodeImg($a->imgWakil, '_wakil');

        $data = [

            'fotoBupati' => "$pathFotoBupati",
            'fotoWakil' => "$pathFotoWakil",
            'namaBupati' => "$a->namaBupati",
            'namaWakil' => "$a->namaWakil",

        ];

        $noUrut = $this->geturut();

        tcalon::create([
            'urut' => $noUrut,
            'data' => json_encode($data),
        ]);

        return 'y';
    }

    public function geturut()
    {
        $noUrut = tcalon::orderBy('urut', 'DESC')->first();

        if ($noUrut == null) {
            $noUrut = 1;
        } else {
            $noUrut = $noUrut->urut + 1;
        }
        return $noUrut;
    }

    public function getcalon()
    {
        return returnjson(tcalon::all());
    }

    public function deletecalon(Request $a)
    {
        tcalon::destroy($a->id);

        $ass = tcalon::orderBy('urut', 'ASC')->get();
        $urut = 1;
        foreach ($ass as $as) {
            tcalon::where('id', $as->id)->update(['urut' => $urut]);
            $urut++;
        }
    }

    public function saveinfotps(Request $a)
    {
        // dd($a);
        $jumlah = (int) $a->lk + (int) $a->pr;
        $dpt = [
            "lk" => $a->lk,
            "pr" => $a->pr,
            "jumlah" => $jumlah,
        ];

        tinfotps::updateOrCreate(['idOperator' => userAuth()->id], [
            'idOperator' => userAuth()->id,
            'dpt' => json_encode($dpt),
            'kertas' => $a->kertas,
            'bilik' => $a->bilik,
            'alas' => $a->alas,
            'tinta' => $a->tinta,
        ]);
    }

    public function getinfotahap()
    {
        // dd(Session::has('user'));
        // JAMMMMM++++++++++++++++++++
        $tanggal = date('d');
        $jam = date('H');
        $menit = date('i');

        $total = $jam . $menit;

        $tahapSatu = false;
        $tahapDua = false;
        $tahapTiga = false;

        if ($tanggal == 28) {
            if ($total > 659 && $total < 1300) {
                $tahapSatu = true;
            } else if ($total > 1259 && $total < 1400) {
                $tahapSatu = true;
                $tahapDua = true;
            } else if ($total > 1359 && $total < 2359) {
                $tahapSatu = true;
                $tahapDua = true;
                $tahapTiga = true;
            }
        }

        $infoTps = tinfotps::where('idOperator', userAuth()->id)->exists();

        $data = [
            "jam" => [
                'tahapSatu' => $tahapSatu,
                'tahapDua' => $tahapDua,
                'tahapTiga' => $tahapTiga,
            ],
            'exist' => [
                "tahapSatu" => true,
                "tahapDua" => false,
                "tahapTiga" => true,
            ],
        ];

        return returnJson($data);
    }
}

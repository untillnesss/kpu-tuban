<?php

namespace App\Http\Controllers;

use App\toperator;
use App\User;
use Auth;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Session;

class apiapi extends Controller
{

    public function dologin(Request $a)
    {
        if (Auth::attempt(['email' => $a->email, 'password' => $a->pass])) {
            Session::put('user', Auth::user());
            return returnjson(true);
        }
        return returnjson(false);
    }

    public function addoperator(Request $a)
    {
        $cek = User::where('email', $a->email)->count();

        if ($cek > 0) {
            return returnJson('x');
        } else {
            $cek = toperator::where('email', $a->email)->count();
            if ($cek > 0) {
                return returnJson('x');
            } else {
                $cek = toperator::where('nomer', $a->nomer)->count();
                if ($cek > 0) {
                    return returnJson('xx');
                }
            }
        }

        toperator::create([
            'nama' => $a->nama,
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
        return DataTables::of(toperator::select('id', 'nama', 'tps', 'kectext', 'keltext', 'email', 'nomer')->get())->make();
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

        toperator::where('id', $a->id)->update([
            'nama' => $a->nama,
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
        $parse = $src;
        $exparse = explode(',', $parse);
        $exparse = base64_decode($exparse[1]);
        $imBup = imageCreateFromString($exparse);

        $nameFile = time() + $sufix;

        $img_file = 'img/calon/bupati.png';
        imagepng($imBup, $img_file, 0);

        return $namaFile+'.png';
    }

    public function addcalon(Request $a)
    {
        $this->decodeImg($a->imgBupati);

    }
}

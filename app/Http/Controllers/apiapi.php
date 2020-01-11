<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\toperator;
use DataTables;
use App\User;
use Curl;

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
        $cek  = User::where('email', $a->email)->count();
        if ($cek > 0) {
            return returnJson('x');
        } else {
            $cek  = toperator::where('email', $a->email)->count();
            if ($cek > 0) {
                return returnJson('x');
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
        ]);

        return returnJson('200');
    }

    public function getoperator()
    {
        return DataTables::of(toperator::select('id', 'nama', 'tps', 'kectext', 'keltext', 'email')->get())->make();
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
        if($a->isChange == 'true'){
            $cek  = User::where('email', $a->email)->count();
            if ($cek > 0) {
                return returnJson('x');
            } else {
                $cek  = toperator::where('email', $a->email)->count();
                if ($cek > 0) {
                    return returnJson('x');
                }
            }
        }

        toperator::where('id', $a->id)->update([
            'nama'=>$a->nama,
            'tps'=>$a->tps,
            'kec'=>$a->kec,
            'kel'=>$a->kel,
            'kectext'=>$a->kectext,
            'keltext'=>$a->keltext,
            'email'=>$a->email,
        ]);

        return returnjson('200');
        // dd($a);
    }
}

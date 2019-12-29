<?php

function returnjson($argc)
{
    return response()->json($argc);
}

function userAuth($a = null)
{
    if($a =='cek'){
        return Session::has('user');
    }
    return Session::get('user');
}

function role($ty, $vi, $pass = [])
{
    if($ty == 'login'){
        if(!userAuth('cek')){
            return redirect()->route('login');
        }else{
            return view($vi, $pass);
        }
    }else if($ty == 'guest'){
        if(userAuth('cek')){
            return redirect()->route('dashboard');
        }else{
            return view($vi, $pass);
        }
    }
}

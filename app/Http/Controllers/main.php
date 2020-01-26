<?php

function returnjson($argc)
{
    return response()->json($argc);
}

function userAuth($a = null)
{
    if ($a == 'cek') {
        return Session::has('user');
    }
    return Session::get('user');
}

function roleApi()
{
    $action = Route::currentRouteAction();

    $action = explode('@', $action);
    $action = explode("\\", $action[0]);

    if ($action[3] == 'apiapi') {
        if (!userAuth('cek')) {
            return abort(401);
        }
    }
}

roleApi();

function role($ty, $vi, $pass = [])
{
    if ($ty == 'login') {
        if (!userAuth('cek')) {
            return redirect()->route('login');
        } else {

            $acc = [
                ['dashboard', 'operator', 'calon'], // ADMIN
                ['ope'], // OPERATOR
            ];

            $index = null;

            if (Session::get('lvl') == 'admin') {
                $index = 0;
            } else {
                $index = 1;
            }

            foreach ($acc[$index] as $bagian) {
                if ($bagian != Route::currentRouteName()) {
                    continue;
                } else {
                    return view($vi, $pass);
                }
            }

            if (Session::get('lvl') == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('ope');
            }

        }
    } else if ($ty == 'guest') {
        if (userAuth('cek')) {
            return redirect()->route('dashboard');
        } else {
            return view($vi, $pass);
        }
    }
}

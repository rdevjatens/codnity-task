<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $login = new Login;
        $users = $login->get();

        $accessGranted = false;

        foreach ($users as $user) {
            if ($user['username'] == $request["username"] && Hash::check($request["password"], $user['password'])) {
                $accessGranted = true;
            }
        }

        return $accessGranted;
    }
}

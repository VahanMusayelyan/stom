<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class CheckActiveController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct() {


        $this->middleware(function ($request, $next) {

            if (Auth::check()) {

                if (Auth::user()->user_active == 1 || Auth::user()->role_id == 1) {

                    return $next($request);
                }
            }
            return redirect('/');
        });
    }

}

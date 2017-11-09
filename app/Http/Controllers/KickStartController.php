<?php
// app/Http/Controllers/KickStartController.php

namespace App\Http\Controllers;

class KickStartController extends Controller {
    /**
     * Generate the starting point of the application     */

    public function index() {
        return view('auth.login');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 27.07.2018
 * Time: 14:18
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index() {
        return view('admin.index');
    }
}
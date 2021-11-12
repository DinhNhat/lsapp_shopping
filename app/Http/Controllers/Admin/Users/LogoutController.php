<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function adminLogout() {
        auth()->logout();

        return redirect()->route('admin.index');
    }
}

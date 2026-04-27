<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('name', $request->name)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            session([
                'admin_login' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name
            ]);

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Nama atau password salah!');
    }

    public function logout()
{
    session()->flush();
    return redirect('/');
}
}
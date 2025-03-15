<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telepon' => 'required|string|min:10|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'foto' => 'default-profile.jpg',
                'name' => $request['name'],
                'address' => $request['address'],
                'telepon' => $request['telepon'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            return redirect('/login');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route("dashboard.home");
        }
        return view("auth.login");
    }

    public function login(Request $request) {
        if (Auth::check()) {
            return redirect()->route("dashboard.home");
        }
        $validated = $request->validate([
            "email_or_username" => ["required"],
            "password" => ["required"]
        ]);
        $user = User::where("username", $validated["email_or_username"])->orWhere("email", $validated["email_or_username"])->first();
        if ($user && !$user->status) {
            return back()->withErrors("Tu cuenta está actualmente inactiva.");
        }
        if ($user && Hash::check($validated["password"], $user->password)) {
            Auth::login($user, $request->has("remember"));
            return redirect()->route("dashboard.home");
        }
        return back()->withErrors("Tus credenciales no coinciden.");
    }
}

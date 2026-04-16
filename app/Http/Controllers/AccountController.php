<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function showAccount()
    {
        return view('account');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('account', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'name_kanji' => 'required|max:255',
            'name_kana' => 'required|max:255',
        ]);

        $user = auth()->user();
        $user->update($request->only([
            'name',
            'email',
            'name_kanji',
            'name_kana'
        ]));

        return redirect()->route('mypage');
    }
}
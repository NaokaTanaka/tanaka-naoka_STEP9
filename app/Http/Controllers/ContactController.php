<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }


    public function submitForm(ContactRequest $request)
    {
        $data = $request->validated();
        try {
            Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail($data));
        } catch (\Exception $e) {
            \Log::error('メール送信エラー: ' . $e->getMessage());
            return back()->with('error', 'メール送信に失敗しました。後でもう一度お試しください。');
        }

        return redirect()->route('products')
            ->with('success', 'お問い合わせ内容が送信されました！');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function admin()
    {
        $contacts = Contact::Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
    public function search(Request $request)
    {
    $query = Contact::query();

    // 名前やメールアドレスで検索
    if ($request->keyword) {
        $query->where(function($q) use ($request) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $request->keyword . '%'])
            ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    // 性別で検索
    if ($request->gender) {
        $query->where('gender', $request->gender);
    }

    // カテゴリで検索
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // 日付で検索
    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->Paginate(7);
    $contacts->appends(request()->except('page'));
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }
}

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
    public function Login(LoginRequest  $request)
    {
        $Login = $request->only(['email', 'password']);
        $contacts = Contact::Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
        public function Register(RegisterRequest  $request)
    {
        $Login = $request->only(['name','email', 'password']);
        $categories = Category::all();
        $contacts = Contact::Paginate(7);
        return view('admin', compact('contacts', 'categories'));
    }
}

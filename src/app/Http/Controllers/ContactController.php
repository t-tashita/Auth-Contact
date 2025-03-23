<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function contact()
    {
        $categories = Category::all();

        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest  $request)
    {
        $contact = $request->only(['first_name','last_name', 'gender', 'email', 'tel_part1', 'tel_part2', 'tel_part3', 'address', 'building', 'category_id', 'detail']);
        $categories = Category::all();
        return view('confirm', compact('contact', 'categories'));
    }

    public function store(ContactRequest  $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
}

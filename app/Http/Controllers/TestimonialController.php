<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use App\Models\Product; 
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable',
            'message' => 'required',
        ]);

        Testimonial::create($request->all());

        return redirect()->back()->with('success', 'Testimonial submitted successfully!');
    }

    public function showTestimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('home.testimonial', compact('testimonials'));
    }
}
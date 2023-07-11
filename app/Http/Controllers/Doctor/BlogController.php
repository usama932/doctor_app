<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    protected  $image_path = 'public/images/blogs/';
    public function index()
    {
        if (Auth::user()->is_doctor())
        {
            return view('doctor.blog.index', [
                'blogs' => Blog::query()->where('doctor_id', Auth::id())->orderBy('id')->get(),
            ]);
        }
        elseif(Auth::user()->is_hospital())
        {
           $blogs = auth()->user()->hospital->blogs->load("user");
            return view('hospital.blog.index', [
                'blogs' => $blogs,
            ]);
        }
        elseif (Auth::user()->is_admin())
        {
            return view('admin.blog.index', [
                'blogs' => Blog::query()->orderByDesc('id')->get(),
            ]);
        }

    }
    // Doctor Routes
    //Create Blog
    public function create()
    {
        return view('doctor.blog.create');
    }
    // Store Blog
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'blog_title' => 'required',
            'slug' => ['required', Rule::unique('blogs', 'slug')],
            'doctor_id' => 'required',
            'blog_body' => 'required',
            'blog_image' => 'required|image',
        ]);
        if ($request->hasFile('blog_image')){
            $file = $request->file('blog_image');
            $filename = time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['blog_image'] = $filename;
        }
        Blog::create($attributes);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Blog Created Successfully']);
    }
    public function edit(Blog $blog)
    {
        if (Auth::user()->is_doctor())
        {
            return view('doctor.blog.edit', [
                'blog' => $blog,
            ]);
        }
        elseif(Auth::user()->is_hospital())
        {
            return view('hospital.blog.edit', [
                'blog' => $blog,
            ]);
        }
        elseif (Auth::user()->is_admin())
        {
            return view('admin.blog.edit', [
                'blog' => $blog,
            ]);
        }
    }
    public function update(Request $request, Blog $blog)
    {
        $attributes = request()->validate([
            'blog_title' => 'required',
            'blog_body' => 'required',
            'blog_image' => 'image'
        ]);

        if ($request->hasFile('blog_image')){
            $file = $request->file('blog_image');
            $filename = $blog->blog_image ?? time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['blog_image'] = $filename;
        }
        $blog->update($attributes);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Blog Update Successfully']);
    }
    public function show(Blog $blog)
    {
        if (Auth::user()->is_doctor())
        {
            return view('doctor.blog.show', ['blog' => $blog]);
        }
        elseif(Auth::user()->is_hospital())
        {
            return view('hospital.blog.show', [
                'blog' => $blog,
                'doctor' => User::query()->where('id', $blog->doctor_id)->get(),
            ]);
        }
        elseif (Auth::user()->is_admin())
        {
            return view('admin.blog.show', [
                'blog' => $blog,
                'doctor' => User::query()->where('id', $blog->doctor_id)->get(),
            ]);
        }

    }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()
            ->route('blogs')
            ->with('flash', ['type', 'success', 'message' => 'Blog Deleted Successfully']);
    }
}

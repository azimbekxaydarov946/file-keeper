<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $search = request()->input('search')??'';

        // dd($search);
        if (auth()->user()->is_role == false ) {

            $home = Home::with('category', 'teacher')->where('user_id', '=', auth()->user()->id)->where(function($query)  use ($search) {
                $query->orWhere('title', 'like', '%' . $search . '%')->orWhere('size', 'like', '%' . $search . '%')->orWhere('type', 'like', '%' . $search . '%')->orWhere('date', 'like', '%' . $search . '%')->orWhereHas('category', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('teacher', function($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                })->orWhereHas('teacher', function($query) use ($search) {
                    $query->where('last_name', 'like', '%' . $search . '%');
                })->orWhereHas('category', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })->get();
        } else {
            $home = Home::with('category', 'teacher')  ->whereHas('teacher', function ($query) {
                $query->where('is_role', false);
            })->where(function($query)  use ($search) {
                $query->orWhere('title', 'like', '%' . $search . '%')->orWhere('size', 'like', '%' . $search . '%')->orWhere('type', 'like', '%' . $search . '%')->orWhere('date', 'like', '%' . $search . '%')->orWhereHas('category', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('teacher', function($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                })->orWhereHas('teacher', function($query) use ($search) {
                    $query->where('last_name', 'like', '%' . $search . '%');
                })->orWhereHas('category', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })->get();
         /*    ->whereHas('teacher', function ($query) {
                $query->where('is_role', false);
            }); */
        }
        $work = [];
        $personal = [];
        $special = [];
        foreach ($home as $item) {

            if ($item->category->name == 'the work') {
                $work[] = $item;
            } else {
                $personal[] = $item;
            }

            if ($item->status == 1) {
                $special[] = $item->status;
            }
        }
        $special = count($special) ?? 0;
        $work = count($work) ?? 0;
        $personal = count($personal) ?? 0;
        $total = count($home) ?? 0;
        return view('home', ['home' => $home, 'work' => $work, 'personal' => $personal, 'total' => $total, 'special' => $special, 'search' => $search]);
    }

    public function create()
    {
        $category = Category::all();
        return view('home.create', ['category' => $category]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,exe,zip,rar,7z',
            'date' => 'nullable',
            'category_id' => 'nullable',
            'status' => 'nullable'
        ]);
        $data['date'] = $data['date'] ?? date('Y-m-d');
        if ($request->hasFile('file')) {

            $file = $data['file'];
            if ($data['title'] == null) {
                $data['title'] = explode('.', $file->getClientOriginalName())[0];
            }
            $data['size'] = substr($file->getSize(), 0, -3); /* size(1024) 1mb 024 kb */
            $data['type'] = $file->getClientOriginalExtension(); /* type file */
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $data['file'] = $fileName;
        }
        // elseif ($data['title'] == null) {
        //     $data['title'] = 'no title';
        // }
        $data['user_id'] = auth()->user()->id;
        Home::create($data);
        return redirect()->route('home');
    }
    public function dowload($id)
    {
        $home = Home::find($id);
        $file = public_path('files/') . $home->file;
        return response()->download($file);
    }

    public function edit($id)
    {
        $home = Home::find($id);
        $category = Category::all();
        return view('home.edit', ['home' => $home, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $item = Home::find($id);
        $data = $request->validate([
            'title' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,exe,zip,rar,7z',
            'date' => 'nullable',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $data['date'] = $data['date'] ?? date('Y-m-d');
        if ($request->hasFile('file')) {
            $file = $data['file'];
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $data['file'] = $fileName;
            $data['size'] = substr($file->getSize(), 0, -3);
            $data['type'] = $file->getClientOriginalExtension();
            if ($item->file != null || public_path("files/") . $item->file) {
                $file = public_path("files/") . $item->file;
                unlink($file);
            }
        }
        // elseif ($data['title'] == null) {
        //     $data['title'] = 'no title';
        // }

        $data['user_id'] = auth()->user()->id;
        $item->update($data);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $item = Home::find($id);
        if (file_exists(public_path("files/") . $item->file)) {
            unlink(public_path('files/') . $item->file);
        }

        $item->delete();
        return redirect()->route('home');
    }
}

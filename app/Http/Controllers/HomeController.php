<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::with('category', 'teacher')->get();
        return view('home', ['home' => $home]);
    }

    public function create()
    {
        $category = Category::all();
        return view('home.create', ['category' => $category]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png',
            'date' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $file=$data['file'];
        $fileName=time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('files'),$fileName);
        $data['file']=$fileName;
        $data['user_id']=auth()->user()->id;
        Home::create($data);
        return redirect()->route('home');
    }
    public function dowload($id)
    {
        $home = Home::find($id);
        $file=public_path('files/').$home->file;
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
        $data = $request->validate([
            'title' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png',
            'date' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $file=$data['file'];
        $fileName=time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('files'),$fileName);
        $data['file']=$fileName;
        $data['user_id']=auth()->user()->id;
        $item=Home::find($id);
        unlink(public_path('files/').$item->file);
        $item->update($data);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $item=Home::find($id);
        unlink(public_path('files/').$item->file);
        $item->delete();
        return redirect()->route('home');
    }
}

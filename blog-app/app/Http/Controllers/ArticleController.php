<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Image;
use Storage;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::latest()->paginate(5);
    
        return view('articles.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('image'));

        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_status' => 'required',
            'comment_status' => 'required'
            // 'image' => 'required|file|image|mimes:png,jpeg,jpg'
        ]);

        $data = $request->all();

        $image = $request->file('image');
        // $path = $image->store('uploads',"public");
        $path = Storage::disk('s3')->put('/', $image, 'public');

        $data['img_name'] = $image->getClientOriginalName();
        // $data['img_path'] = $path;
        $data['img_path'] = Storage::disk('s3')->url($path);

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success','Post created successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
            'post_status' => 'required',
            'comment_status' => 'required'
        ]);
    
        $article->update($request->all());
    
        return redirect()->route('articles.index')
            ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success','Articles deleted successfully');
    }
}

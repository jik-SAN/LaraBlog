<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    public function sanitize($request)
    {
        $request->title = filter_var($request->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $request->description = filter_var($request->description, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        /*similar to above but using htmlspecialchars
        $request->title = htmlspecialchars("$request->title", ENT_NOQUOTES, 'UTF-8');
        $request->description = htmlspecialchars("$request->description", ENT_NOQUOTES, 'UTF-8');*/
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(1);
        return view('blog.index')
        ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->sanitize($request);

        $request->validate([
            'title' => 'required|regex:/^[\s\w\d\.-]+$/|string|max:200|min:5',
            'description' => 'required|string|max:1000|min:10',
            'image' => 'required|mimes:jpg,jpeg,png|max:5048'
        ],
        [       'title.regex' => 'Only letters, numbers, dashes and underscores.',
            ]);

        $request->file('image')->store('public');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $request->image->hashName(),
            'slug' => SlugService::CreateSlug(Post::class, 'slug', $request->title),
            'user_id' => Auth::id(),
        ]);

        return to_route('blog.index')->with('message', 'Your post has been added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')
        ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')
        ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->sanitize($request);

        $request->validate([
            'title' => 'required|regex:/^[\s\w\d\.-]+$/|string|max:200|min:5',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:5048'
        ],
        [       'title.regex' => 'Only letters, numbers, dashes and underscores.',
            ]);

        $post = Post::where('slug',$slug)->firstOrFail();
        $post->title = $request->title;
        $post->description = $request->description;
        if ($request->hasFile('image')) {
            $request->file('image')->store('public');
            $post->image_path = $request->image->hashName();
        }

        $post->save();

        return to_route('blog.index')->with('message',
            'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug',$slug)->firstOrFail();
        $post->delete();

       return to_route('blog.index')->with('message',
            'Your post has been deleted!');
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'alpha_num',
        ]);
        $search = $request->search;
        $posts = Post::query()
            ->where('title', 'LIKE', "%".$search."%")
            ->orWhere('description', 'LIKE', "%".$search."%")
            ->paginate(1);
            // dd($posts);
        return view('blog.search')->with('posts', $posts);

    }
}

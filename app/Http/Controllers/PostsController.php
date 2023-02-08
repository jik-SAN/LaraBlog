<?php

namespace App\Http\Controllers;


use App\Mail\PostCreatedMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Uploadcare\Configuration;
use \Uploadcare\Api;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    public function sanitize($request)
    {
        $request->title = filter_var(strip_tags($request->title), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $request->description = filter_var(strip_tags($request->description), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        /*similar to above but using htmlspecialchars
        $request->title = htmlspecialchars("$request->title", ENT_NOQUOTES, 'UTF-8');
        $request->description = htmlspecialchars("$request->description", ENT_NOQUOTES, 'UTF-8');*/
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(5);
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
            'image' => 'required|mimes:jpg,jpeg,png|max:1048'
        ],
        [       'title.regex' => 'Only letters, numbers, dashes and underscores.',
    ]);

        if ($request->hasFile('image')) {
            $configuration = Configuration::create(env('UPLOADCARE_PUBLIC_KEY'), env('UPLOADCARE_PRIVATE_KEY'));
            $uploader = (new Api($configuration))->uploader();
            $result = $uploader->fromPath($request->image, 'image/jpeg');
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $result->getOriginalFileUrl(),
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id(),
        ]);
        $user = User::find(Auth::id());

        Mail::to($user->email)->send(new PostCreatedMail($post, $user));

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
            'image' => 'mimes:jpg,jpeg,png|max:1048'
        ],
        [       'title.regex' => 'Only letters, numbers, dashes and underscores.',
    ]);

        $post = Post::where('slug',$slug)->firstOrFail();
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $configuration = Configuration::create(env('UPLOADCARE_PUBLIC_KEY'), env('UPLOADCARE_PRIVATE_KEY'));
            $uploader = (new Api($configuration))->uploader();
            $result = $uploader->fromPath($request->image, 'image/jpeg');
            $post->image_path = $result->getOriginalFileUrl();
        }

        $post->slug = Str::slug($request->title);
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
        ->paginate(5);
            // dd($posts);
        return view('blog.search')->with('posts', $posts);

    }
}

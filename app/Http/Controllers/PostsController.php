<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use Illuminate\Support\Facades\Storage;
use \Waavi\Sanitizer\Sanitizer;
use Elasticsearch\ClientBuilder;
use App\Notifications\NewPost;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        /*
         * Blocks guests from using the controllers views, except the index and show view
         */
        $this->middleware('auth', ['except' => ['index', 'show']]);

        /*
         * Adds create permission middleware to the routes create and store only. 
         * If the user tries to access either create or store routes, the middleware
         * will check to see if the user has the required authorization. If the user
         * does not have access, a 403 exception will be thrown.
         */
        // $this->middleware('permission:create', ['only' => ['create', 'store']]);
         
        //  /*
        //   * Adds edit permission middleware to routes edit and update. 
        //   * On edit and updaly users withte permissions will be able to
        //   * access these routes.
        //   */
        // $this->middleware('permission:edit', ['only' => ['edit', 'update']]); 
         
        //  /*
        //   * Add the delete permission middleware to routes show and delete.
        //   * Only users with show and delete permissions will be able to access
        //   * these routes.
        //   */
        // $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Select all posts
        // $posts = Post::all();

        // With where. Here I choose with title
        // return Post::where('title', 'Post two')->get();
        
        // Select all and order by
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        // Select one
        // $posts = Post::orderBy('title', 'asc')->take(1)->get();
        
        // With database query
        // $posts = DB::select('SELECT * FROM posts');

        // With paginator. Must have {{$posts->links()}} in view
        // $posts = Post::orderBy('title', 'asc')->paginate(1);
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        // Title and body required
        // Image is optional, this is done with nullable, max size with max
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Sanitize with waafi
        $data = [
            'title'    =>  $request->request->get('title'),
            'body'     =>  $request->request->get('body'),
        ];

        $filters = [
            'title'    =>  'trim|escape|capitalize',
            'body'     =>  'trim|escape|capitalize',
        ];
    
        $sanitizer  = new Sanitizer($data, $filters);
        $sanitizedData = $sanitizer->sanitize();
        
        // Handle file upload
        if($request->hasFile('cover_image')){
            
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
            
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        // Create post
        $post = new Post();
        // Old 
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');

        // New with waafi sanitizer
        $post->title = $sanitizedData['title'];
        $post->body = $sanitizedData['body'];

        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;

        // Save
        $post->save();

        // // Prepare data for elasticsearch
        // $data = [
        //     'body' => [
        //         'title' => $post->title,
        //         'body' => $post->body
        //     ],
        //     'index' => 'blog',
        //     'type' => 'post',
        //     'id' => $post->user_id,
        // ];
        
        
        // // Insert post data to elasticsearch
        // $client = ClientBuilder::create()->build();
        // $return = $client->index($data);
        
        // Notify users for new post
        auth()->user()->notify(new NewPost($post));

        // Redirect
        return redirect('/posts')->with('success', 'Post created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //$this->checkRankRefresh(Post::all());

        return view('posts.show')->with('post', $post);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for currect user
        if(auth()->user()->id == $post->user->id){
            return view('posts.edit')->with('post', $post);
        }else{
            return redirect('posts')->with('error', 'Unauthorized page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // Validation
        // Make title and body required
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Find post
        $post = Post::find($id);
        
        // Handle file upload
        if($request->hasFile('cover_image')){
            
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        
        // Create post
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $filenameToStore;
        }

        // Save
        $post->save();

        // Redirect
        return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }

    protected function checkRankRefresh($posts)
    {
        //if(count($posts->user) > 0)
        
        dd($posts);
        //$comments = App\Post::find(1)->comments()->where('title', 'foo')->first()
    }
}

        
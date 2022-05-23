<?php

namespace App\Http\Controllers\Admin;


use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ottengo tutti i post dell'utente loggato
        $posts = Post::orderBy('updated_at', 'desc')->where('user_id', '=', Auth::id())->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // categorie per la select
        $categories = Category::all();
        // tags per la checkbox
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories'), compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // VALIDATE
        $validate = $request->validate(
        [
            'title' => 'required|max:240',
            'content' => 'required',
            'category_id' => 'exists:App\Model\Category,id',
            'tags.*' => 'nullable|exists:App\Model\Tag,id',
            'photo' => 'nullable|image'
        ]
        );

        // CREATE NEW POST
        $newPost = new Post();


        $newPost->fill($data);
        $newPost->user_id = Auth::id();
        $newPost->slug = Post::createSlug($data['title'], 'post');

        // Upload foto se caricata nel form
        if (!empty($data['photo'])) {
            $img_path = Storage::put('uploads/posts', $data['photo']);
            $newPost['image'] = $img_path;
        }
        $newPost->save();

        // associa i tags al post
        $newPost->tag()->attach($data['tags']);

        return redirect()->route('admin.posts.show', $newPost->slug)->with('status', 'Post ' . $newPost->title . ' created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $validate = $request->validate(
        [
            'title' => 'required|max:240',
            'content' => 'required',
            'category_id' => 'required | exists:App\Model\Category,id',
            'tags.*' => 'nullable|exists:App\Model\Tag,id',
            'photo' => 'nullable|image'
        ]);

        // CHECK & UPDATE IF WE HAVE ANY CHANGE
        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = Post::createSlug($data['title'], 'post');
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }

        // photo
        if (!empty($data['photo'])) {
            Storage::delete($post->image);
            $img_path = Storage::put('uploads/posts', $data['photo']);
            $post['image'] = $img_path;
        }

        $post->update();
        // tags
        if ((isset($data['tags']))) {
            $post->tag()->sync($data['tags']);
        }
        else {
            $post->tag()->detach();
        }

        return redirect()
            ->route('admin.posts.show', $post->slug)
            ->with('status', 'Post ' . $post->title . ' updated.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tag()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('statusError', "Post $post->title deleted");
    }

}

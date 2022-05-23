<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Category;
use App\Model\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('updated_at','desc')->paginate(5);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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

        // VALIDAZIONE
        $validate = $request->validate([
            'name' => 'required | max:240 | unique:App\Model\Category,name'
        ]);

        $newCategory = new Category;
        $newCategory->fill($data);
        $newCategory->slug = Post::createSlug($newCategory->name,'category');
        $newCategory->save();

        return redirect()
            ->route('admin.categories.index', )
            ->with('status', 'Category ' . $newCategory->name . ' created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @param  $name : $category->name
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categoryName = $category->name;
        $posts = $category->posts()->orderBy('updated_at','desc')->where('category_id', $category->id)->paginate(5);
        return view('admin.categories.show', ['posts' => $posts,'categoryName' => $categoryName]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $validate = $request->validate([
            'name' => 'required | max:240 | unique:App\Model\Category,name'
        ]);

        $category->name = $data['name'];
        $category->slug = Post::createSlug($data['name'],'category');

        $category->update($data);

        return redirect()
            ->route('admin.categories.show', $category->slug)
            ->with('status', 'category ' . $category->name. ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $generic_id = Category::where('name', 'generic')->first()->id;
        $post_change_id = Post::where('category_id', $category->id)->get();
        $category->delete();
        foreach($post_change_id as $post) {
            $post->category_id = $generic_id;
            $post->save(['category_id']);
        }

        return redirect()->route('admin.categories.index')->with('statusError', "Category $category->name deleted");
    }
}

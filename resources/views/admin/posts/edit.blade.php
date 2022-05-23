@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row  w-75 mx-auto ">
            <div class="col card p-3">
                <h2>Edit {{ $post->title }}</h2>

                @if (!empty($post['image']))
                    <img class="d-block mx-auto img img-fluid" src="{{ asset('storage/' . $post['image']) }}"
                        alt="{{ $post['title'] }}">
                @endif
                <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    {{-- EDIT CATEGORY --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach ($categories as $category)
                                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- TAG SELECT --}}
                    <fieldset class="mb-3">
                        <legend>Tags</legend>
                        @foreach ($tags as $tag)
                            <div class="form-check-inline">
                                <input class="form-check-input" @if (in_array($tag->id, old('tags', []))) checked @endif
                                    type="checkbox" value="{{ $tag->id }}" name="tags[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </fieldset>


                    {{-- EDIT POST TITLE --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- EDIT POST CONTENT --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3"
                            name="content">{{ $post->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- EDIT UPLOAD --}}
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" value="">
                        @error('photo')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input class="btn btn-primary" type="submit" value="Salva">
                </form>
                <div class="row">
                    <div class="col-12">
                        <a class='nav-link' href="{{ route('admin.posts.show', $post->slug) }}">Show detail post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

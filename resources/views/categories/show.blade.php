@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    <div class="container-fluid">
        {{-- MESSAGGIO REDIRECT STATUS --}}
        @if (session('status'))
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        {{-- FINE MESSAGGIO REDIRECT STATUS --}}
        <h2 class="w-100 text-center">All post of Category: {{ $categoryName }}</h2>
        <div class="cards">
            @if (count($posts) === 0)
                <h4 class="w-75 mx-auto">Non sono presenti post in questa categoria.</h4>
            @else
                @foreach ($posts as $post)
                    {{-- @php $categoryMany = $posts->items()[$key]; @endphp --}}
                    <div class="card w-75 mx-auto mb-3 border-2 rounded">
                        <div class="card-body">
                            {{-- HEADER --}}
                            @include('partials.main.header')

                            <hr class="bg-primary">

                            {{-- POST CONTENT --}}
                            <p class="card-text h4">
                                <em>
                                    {{ $post->content }}
                                </em>
                            </p>
                            <hr class="bg-primary">
                            {{-- POST TAGS --}}
                            @if (count($post->tag()->get()) > 0)
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group list-group-horizontal flex-wrap mx-auto">
                                            @foreach ($post->tag()->get() as $tag)
                                                <li class="list-group-item border-0">
                                                    <a class=" text-decoration-none"
                                                        href="{{ route('admin.tags.show', $tag) }}">
                                                        <span
                                                            class="rounded-pill bg-secondary text-light h6 p-2 font-weight-bold">
                                                            #{{ $tag->name }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

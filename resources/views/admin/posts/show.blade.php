@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    <div class="container-fluid">
        {{-- MESSAGGIO REDIRECT STATUS --}}
        @if (session('status'))
            <div class="col-6 mx-auto">
                <div class="row">
                    <div class="alert alert-success mx-auto">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        {{-- FINE MESSAGGIO REDIRECT STATUS --}}

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
                                        <a href="{{ route('admin.tags.show', $tag) }}">
                                            <span
                                                class="rounded-pill bg-secondary text-white h6 p-2 font-weight-bold text-decoration-none">
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
    </div>
@endsection

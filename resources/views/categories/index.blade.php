@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- REDIRECT STATUS MESSAGE --}}
            @if (session('statusError'))
                <div class="col-6 mx-auto">
                    <div class="alert alert-danger">
                        {{ session('statusError') }}
                    </div>
                </div>
            @endif
            @if (session('status'))
                <div class="col-6 mx-auto">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            {{-- FINE REDIRECT STATUS MESSAGE --}}
            <h1 class="w-100 text-center">CATEGORIES</h1>
            {{-- DATI CATEGORIES --}}

            {{-- STAMPA DATI POST --}}
            <div class="cards w-75 mx-auto d-flex flex-column align-items-center">
                @foreach ($categories as $category)
                    <div class="card text-center mb-3 p-3">
                        <div class="card-body">
                            <h4 class="card-title h3 text-uppercase">
                                <a class="text-decoration-none text-primary"
                                    href="{{ route('admin.categories.show', $category) }}">
                                    <em>
                                        {{ $category->name }}
                                    </em>
                                </a>
                            </h4>
                            <h5 class="card-subtitle mb-2 text-muted"><b>Created: </b>{{ $category->created_at }}</h5>

                            @if ($category->slug !== 'generic')
                                <div class="d-flex justify-content-center">
                                    {{-- EDIT POST --}}
                                    <a class="btn ms-2 text-success"
                                        href="{{ route('admin.categories.edit', $category->slug) }}"><i
                                            class="bi bi-pen"></i></a>
                                    {{-- DELETE POST --}}
                                    <form class="ms-2"
                                        action="{{ route('admin.categories.destroy', $category->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit">
                                            <i class="d-block bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif


                        </div>
                    </div>
                @endforeach
                <div class="col mb-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

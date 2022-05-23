{{-- HEADER   --}}
<header class="header">
    <div class="row justify-content-between">
      {{-- POST TITLE --}}
      <div class="col-12 col-md-9">
        <h2 class="card-tile mb-2 h2">
          {{-- VIEW POST --}}
          <a class="text-dark text-uppercase" href="{{ route('admin.posts.show', $post) }}">
            {{$post->title}}
          </a>
        </h2>
      </div>
      <div class="col-12 col-md-3">
        {{-- EDIT & DELETE --}}
        <ul class="list-inline d-flex justify-content-start justify-content-md-end">
          {{-- EDIT POST --}}
          <li class="list-inline-item">
            <a class="btn text-success ms-2" href="{{ route('admin.posts.edit', $post) }}" title="Edit {{$post->title}}">
              <i class="bi bi-pen"></i>
            </a>
          </li>
          {{-- DELETE POST --}}
          <li class="list-inline-item">
            <form class="" action="{{ route('admin.posts.destroy', $post) }}" method="post" title="Delete {{$post->title}}">
                @csrf
                @method('DELETE')
                <button class="btn" type="submit">
                  <i class="d-block bi bi-trash text-danger"></i>
                </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
    {{-- POST IMAGE --}}
    @if(!empty($post['image']))
      <img class="d-block mx-auto img img-fluid" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}">
    @endif
    <div class="row mt-3">
      <div class="col">
        {{-- CATEGORY & AUTHOR --}}
        <div class="d-flex justify-content-between align-items-center">
          {{-- CATEGORY  --}}
          <span class="card-text text-info h5">
            {{$post->category()->first()->name}}
          </span>
          {{-- POST AUTHOR --}}
          <span class="card-subtitle text-muted">
            Created by {{$post->user()->first()->name}} - {{$post->created_at->format('d-m-Y H:i')}}.
          </span>
        </div>
      </div>
    </div>
  </header>
  {{-- FINE HEADER  --}}

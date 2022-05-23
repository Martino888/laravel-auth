{{-- @if(Auth::check()) --}}
<nav class="navbar d-block bg-light sidebar position-sticky sticky-top" id="sidebarMenu">
    <ul class="nav flex-column">
        {{-- DASHBOARD --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-item-center
            @if(Route::currentRouteName() === 'admin.home')
            active
            @endif" href="{{route('admin.home')}}">
                <i class="bi bi-info-square d-block mr-2"></i>
                {{Auth::user()->name}}
            </a>
        </li>
        {{-- POSTS --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-items-center
            @if(Route::currentRouteName() === 'admin.posts.index')
            active
            @endif" href="{{route('admin.posts.index')}}">
                <i class="bi bi-stickies d-block mr-2"></i>
                Posts
            </a>
            <ul class="nav flex-column mx-3">
                <li class="nav-item">
                    <a class="d-flex nav-link align-items-center
                    @if(Route::currentRouteName() === 'admin.posts.create')
                    active
                    @endif" href="{{route('admin.posts.create')}}">
                        <i class="bi bi-file-earmark-plus d-block mr-2"></i>
                        Add Post
                    </a>

                </li>
            </ul>
        </li>
        {{-- CATEGORIES --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-items-center
            @if(Route::currentRouteName() === 'admin.categories.index')
            active
            @endif" href="{{route('admin.categories.index')}}">
                <i class="bi bi-bookmark d-block mr-2"></i>
                Categories
            </a>
            <ul class="nav flex-column mx-3">
                <li class="nav-item">
                    <a class="d-flex nav-link align-items-center
                    @if(Route::currentRouteName() === 'admin.categories.create')
                    active
                    @endif" href="{{route('admin.categories.create')}}">
                        <i class="bi bi-bookmark-plus d-block mr-2"></i>
                        Add Category
                    </a>
                </li>
            </ul>
        </li>
        {{-- TAGS --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-items-center
            @if(Route::currentRouteName() === 'admin.tags.index')
            active
            @endif" href="{{route('admin.tags.index')}}">
                <i class="bi bi-tag d-block mr-2"></i>
                Tags
            </a>
            <ul class="nav flex-column mx-3">
                <li class="nav-item">
                    <a class="d-flex nav-link align-items-center
                    @if(Route::currentRouteName() === 'admin.tags.create')
                    active
                    @endif" href="{{route('admin.tags.create')}}">
                        <i class="bi bi-tags d-block mr-2"></i>
                        Add Tags
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
{{-- @endif --}}

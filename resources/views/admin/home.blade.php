@extends('layouts.admin')

@section('script')
    <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card w-75 mx-auto">
                    <div class="card-title ms-4 my-2 text-primary">
                        <h1>
                            Welcome {{ Auth::user()->name }}
                        </h1>
                    </div>
                    {{-- USER INFO --}}
                    <div class="card-body">
                        <h3>Your info</h3>
                        <div>
                            Email : {{ Auth::user()->email }}
                        </div>
                        <hr>
                        <div>
                            Phone Number : {{ Auth::user()->userInfo()->first()->phone }}
                        </div>
                        <hr>
                        <div>
                            Address : {{ Auth::user()->userInfo()->first()->address }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

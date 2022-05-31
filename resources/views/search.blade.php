<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    @if(session()->get('message'))
        <div class="alert alert-success my-2">
          {{ session()->get('message') }}
        </div>
        @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('search') }}">
                @csrf
                @method('POST')
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="search movie" name="movie">
                    <button type="submit" class="btn btn-dark">Search</button>
                  </div>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            @foreach($movies as $movie)
                            <div class="col col-sm-6">
                                <div class="card h-100">
                                    <div class="card-body flex">
                                        <div class="mx-3">
                                            <img src="{{$movie->Poster}}" width="250">
                                        </div>
                                        <div class="d-flex justify-content-between w-100">
                                            <div>
                                                <h1 class="card-title">{{$movie->Title}}<span> ({{$movie->Year}})</span></h1>
                                                <small>{{$movie->Plot}}</small>
                                            </div>
                                            @if (Auth::check())
                                            <form method="post" action="{{ route('favourite') }}">
                                                @csrf
                                                <input type="hidden" name="Plot" value="{{$movie->Plot}}">
                                                <input type="hidden" name="Year" value="{{ $movie->Year}}">
                                                <input type="hidden" name="Title" value="{{$movie->Title}}">
                                                <input type="hidden" name="Poster" value="{{$movie->Poster}}">
                                                <input type="hidden" name="imdbID" value="{{$movie->imdbID}}">
                                                <input type="hidden" name="searchvalue" value="{{$search_value}}">
                                                <button type="submit" class="hover:text-gray-500 bg-white"><i class="far fa-heart fa-xl"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>

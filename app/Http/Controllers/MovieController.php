<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FavouriteMovie;

class MovieController extends Controller
{
    public function index() {

        $response = Http::get('https://www.omdbapi.com/?s=star&apikey='. env('API_KEY'));

        $search_value = 'star';
        $movie_fetch = json_decode($response->body());

        $movies = array();
        $movie_list = $movie_fetch->Search;
        foreach($movie_list as $movie) {
            $details = Http::get('https://www.omdbapi.com/?i='.$movie->imdbID.'&apikey='.env('API_KEY'));
            $movies[] = json_decode($details->body());
        }



        return view('account', compact('movies', 'search_value'));
    }

    public function find_movies(Request $request) {

        $search_value = $request->input('movie');

        $response = Http::get('https://www.omdbapi.com/?s='.$search_value.'&apikey='. env('API_KEY'));
        $movie_fetch = json_decode($response->body());

        $movies = array();
        $movie_list = $movie_fetch->Search ?? null;
        if($movie_list) {
            foreach($movie_list as $movie) {
                $details = Http::get('https://www.omdbapi.com/?i='.$movie->imdbID.'&apikey='.env('API_KEY'));
                $movies[] = json_decode($details->body());
            }
        }

        return view('search', compact('movies', 'search_value'));
    }

    public function add_favourite(Request $request)
    {
        $storeMovie = $request->validate([
            'Plot' => 'required',
            'Year' => 'required',
            'Title' => 'required',
            'Poster' => 'required'
        ]);

        FavouriteMovie::firstOrCreate($storeMovie);

        return redirect('/')->with('message', 'Movie Saved as Favourite');
    }

    public function show_favourites() {
        return view('favourites');
    }
}

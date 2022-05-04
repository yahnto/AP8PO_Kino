<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Movie;
use \App\Screening;
use App\Reservation;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allMovies = Movie::all();
        return view('movies.index', [ 'allMovies' => $allMovies ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'length' => 'required|int',
            'genre' => 'required|max:255',
            'language' => 'required|max:255',
            'actors' => 'required|max:255',
        ]);

        $movie = new Movie();

        $movie->title = $request->title;
        $movie->length = $request->length;
        $movie->genre = $request->genre;
        $movie->language = $request->language;
        $movie->actors = $request->actors;


        $movie->save();

        return redirect(route('movies.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getMovie = Movie::where('id', $id)->first();
        //dd($getMovie);
        return view('movies.edit', ['movie' => $getMovie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'length' => 'required|int',
            'genre' => 'required|max:255',
            'language' => 'required|max:255',
            'actors' => 'required|max:255',
        ]);

        $movie = Movie::find($id);

        $movie->title = $request->title;
        $movie->length = $request->length;
        $movie->genre = $request->genre;
        $movie->language = $request->language;
        $movie->actors = $request->actors;


        $movie->save();

        return redirect(route('movies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservationsToDelete = DB::table('reservations')->select('reservations.id','user_id','screening_id')
        ->join('screenings', 'reservations.screening_id', '=', 'screenings.id')
        ->where('movie_id', '=',$id)
        ->get();

        foreach ($reservationsToDelete as $deleteReservation) {
            $deleteReservations = Reservation::destroy($deleteReservation->id);
        }

        $deleteMovie = Screening::where('screenings.movie_id', $id)->get();

        foreach ($deleteMovie as $screeningToDelete) {
            $screeningsDelete = Screening::destroy($screeningToDelete->id);
        }

        //select * from reservations inner join screenings on reservations.screening_id = screenings.id;

        $deleteMovie = Movie::destroy($id);

        return redirect(route('movies.index'));
    }
}

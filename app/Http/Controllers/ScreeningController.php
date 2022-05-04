<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Movie;
use \App\Screening;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenings = DB::table('screenings')->select('movies.title','start_time','screenings.id')
        ->join('movies', 'screenings.movie_id', '=', 'movies.id')
        ->orderBy('start_time')
        ->get();

        //Dokoncit pocet rezervacii
        // select screening_id from screenings inner join reservations on screenings.id = reservations.screening_id where screenings.id = 1;
        //$screenings->put('nOfReservations',0);

        foreach ($screenings as $screening) {
            $nOfReservations = DB::table('screenings')->select('screening_id')
            ->join('reservations', 'screenings.id', '=', 'reservations.screening_id')
            ->where('screenings.id', $screening->id)
            ->count();

            $screening->nOfReservations = $nOfReservations;
        }
        //dd($screenings);
        return view('screenings.index', [ 'screenings' => $screenings ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::all();

        return view('screenings.create', ['movies' => $movies]);
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
            'date' => 'required|date',
            'time' => 'date_format:H:i'
        ]);

        $screening = new Screening();
        
        $screeningToParse = $request->date . ' ' . $request->time;

        $insertedScreeningDateTime_start = Carbon::parse($screeningToParse);

        $screening->movie_id = $request->movie;
        $screening->start_time = $insertedScreeningDateTime_start;

        $screening->save();
        return redirect(route('screenings.index'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $screeningDelete = Screening::destroy($id);
        return redirect(route('screenings.index'));
    }
}

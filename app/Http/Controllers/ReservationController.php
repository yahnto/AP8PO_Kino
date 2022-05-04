<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select movies.title,start_time from screenings inner join movies on screenings.movie_id = movies.id inner join reservations on screenings.id = reservations.screening_id where reservations.user_id = 5;
        $reservations = DB::table('screenings')->select('movies.title','start_time','reservations.id')
        ->join('movies', 'screenings.movie_id', '=', 'movies.id')
        ->join('reservations', 'screenings.id', '=', 'reservations.screening_id')
        ->where('reservations.user_id', '=',auth()->user()->id)
        ->orderBy('start_time')
        ->get();

        //select movies.title,start_time,users.name from screenings inner join movies on screenings.movie_id = movies.id inner join reservations on screenings.id = reservations.screening_id inner join users on reservations.user_id = users.id;
        $allReservations = DB::table('screenings')->select('movies.title','start_time','reservations.id','users.name')
        ->join('movies', 'screenings.movie_id', '=', 'movies.id')
        ->join('reservations', 'screenings.id', '=', 'reservations.screening_id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->orderBy('start_time','asc','users.id','asc')
        ->get();
        return view('reservations.index', [ 'reservations' => $reservations, 'allReservations' => $allReservations ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newReservation = new Reservation();
        $newReservation->user_id = auth()->user()->id;
        $newReservation->screening_id = $request->screening_id;
        $newReservation->save();
        return redirect(route('reservations.index'));
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
        $reservationDelete = Reservation::destroy($id);
        return redirect(route('reservations.index'));
    }
}

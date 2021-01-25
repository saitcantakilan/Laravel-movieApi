<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;
        //return response(Movie::with('director')->get(),200);
        $qb = Movie::with('director');
        if($request->has('title'))
            $qb->where('title','like','%'.$request->query('title').'%');
        if($request->has('category'))
            $qb->where('category','like','%'.$request->query('category').'%');
        if($request->has('country'))
            $qb->where('country','like','%'.$request->query('country').'%');
        if($request->has('directorID'))
            $qb->where('director_id','=',$request->query('directorID'));

        if($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'),$request->query('sort','DESC'));


        $data = $qb->offset($offset)->limit($limit)->get();
        return response($data,200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie;
        $movie->director_id = $request->director_id;
        $movie->title = $request->title;
        $movie->category = $request->category;
        $movie->country = $request->country;
        $movie->year = $request->year;
        $movie->imdb_score = $request->imdb_score;
        $movie->save();

        return response([
           'data' => $movie,
           'message' => 'Movie created.'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($id,$start_year = null,$end_year = null)
    {
        if(!is_null($start_year) && !is_null($end_year))
        {
            $movie = Movie::with('director')->whereBetween('year',[$start_year,$end_year])->get();
            if($movie)
                return response($movie,200);
            else
                return response(['message' => 'Movies not found!'],404);
        }
        else if($id != "top10")
        {
            $movie = Movie::with('director')->find($id);
            if($movie)
                return response($movie,200);
            else
                return response(['message' => 'Movie not found!'],404);

        }
        else
        {
            $movie = Movie::with('director')->take(10)->orderBy('imdb_score','DESC')->get();
            if($movie)
                return response($movie,200);
            else
                return response(['message' => 'Movies not found!'],404);
        }


    }

    public function showBetween($start_year = null,$end_year = null)
    {
        if(!is_null($start_year) && !is_null($end_year))
        {
            $movie = Movie::with('director')->whereBetween('year',[$start_year,$end_year])->get();
            if($movie)
                return response($movie,200);
            else
                return response(['message' => 'Movies not found!'],404);
        }
        else
            {

            return response(['message' => 'Movies not found!'],404);
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //$input  = $request->all();
        //$movie->update($input);
        $movie->director_id = $request->director_id;
        $movie->title = $request->title;
        $movie->category = $request->category;
        $movie->country = $request->country;
        $movie->year = $request->year;
        $movie->imdb_score = $request->imdb_score;
        $movie->save();


        return response([
            'data' => $movie,
            'message' => 'Movie updated.'
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response([
            'message' => 'Movie deleted.'
        ],200);
    }
}

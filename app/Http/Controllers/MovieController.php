<?php

namespace App\Http\Controllers;


use App\Models\Movie;
use App\Http\Requests\StoreUpdateMovieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    

    protected $request;
    protected $repository;

    public function __construct(Request $request, Movie $movie ){
        
        $this->request = $request;
        $this->repository = $movie;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::latest()->paginate(7);

        return view('admin.pages.movies.index',[
            'movies' => $movies,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateMovieRequest $request)
    {
        $data = $request->only('name', 'sinopse');


        if ($request->hasFile('image') && $request->image->isValid()) {
            
            
            $imagePatch = $request->image->store('movies');

            $data['image'] = $imagePatch;
        }

        $this->repository->create($data);

        return redirect()->route('movies.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$movie =  $this->repository->find($id))
            return redirect()->back();
        

        return view ('admin.pages.movies.show',[
            'movie' => $movie  
        ]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$movie =  $this->repository->find($id))
            return redirect()->back();


        return view ('admin.pages.movies.edit', compact('movie')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateMovieRequest   $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update( StoreUpdateMovieRequest $request, $id)
    {
        if(!$movie =  $this->repository->find($id))
            return redirect()->back();
        
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {
           
            if ($movie->image && Storage::exists($movie->image)){
                Storage::delete($movie->image);
            }
            
            $imagePatch = $request->image->store('movies');
    
            $data['image'] = $imagePatch;
        }
    
        
        $movie->update($data);

        return redirect()->route('movies.index'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie =  $this->repository->where('id', $id)->first();
        if(!$movie)
            return redirect()->back();

            if ($movie->image && Storage::exists($movie->image)){
                Storage::delete($movie->image);
            }
        $movie->delete();

        return redirect()->route('movies.index'); 
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $movies = $this->repository->search($request->filter);

        return view('admin.pages.movies.index', [
            'movies' => $movies,
            'filters' => $filters,
        ]);
        
    }

}

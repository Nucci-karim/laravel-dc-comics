<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::All();
        return view('pages.index', compact( 'comics' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'pages.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title'=>'required|unique:comics|max:255'
        ],
        [
           'title.required'=>'Il campo è obbligatorio',
           'title.unique'=>'Il dato è già presente',
           'title-max'=>'Il titolo supera il valore massimo' 
        ]);

        $form_data = $request->all();

        $new_comic = new Comic();
        /*         $new_pasta->title = $form_data['title'];
                $new_pasta->description = $form_data['description'];
                $new_pasta->type = $form_data['type'];
                $new_pasta->image = $form_data['image'];
                $new_pasta->cooking_time = $form_data['cooking_time'];
                $new_pasta->weight = $form_data['weight']; */
        
        
                //Solo grazie al model con protected $fillable
                $new_comic->fill( $form_data );
        
                $new_comic->save();
        
                return redirect()->route( 'comics.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fumetto = Comic::find($id);
        return view('pages.fumetto', compact( 'fumetto' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('pages.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        // validate
        $request->validate([
            'title'=>'required|unique:comics|max:255'
        ],
        [
            'title.required'=>'Il campo è obbligatorio',
            'title.unique'=>'Il dato è già presente',
            'title-max'=>'Il titolo supera il valore massimo' 
         ]);

        $form_data = $request->all();
        $comic->update($form_data);

        return redirect()->route('comics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();

        return redirect()->route('comics.index');
    }
}
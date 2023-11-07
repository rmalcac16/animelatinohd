<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use QueryException;
use Exception;

class GenreController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'genres' => Genre::orderBy('title', 'asc')->get(),
            'category_name' => 'genres',
            'page_name' => 'listGenres',
        ];

        return view('admin.genres.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'category_name' => 'genres',
            'page_name' => 'create',
        ];
        return view('admin.genres.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255|unique:genres',
            ]);

            $genre = new Genre();
            $genre->title = $request->title;
            $genre->slug = Str::slug($request->title);
            $genre->save();
            return redirect()->route('admin.genres.index')->with('success', 'Género añadido correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al agregar el género: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al agregar el género: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $data = [
            'category_name' => 'genres',
            'page_name' => 'edit',
            'genre' => $genre
        ];
        return view('admin.genres.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255|unique:genres',
            ]);
    
            $genre->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);
    
            return redirect()->route('admin.genres.index')->with('success', 'Género actualizado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al editar el género: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al editar el género: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        try {
            $genre->delete();
            return redirect()->route('admin.genres.index')->with('success', 'Género eliminado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al eliminar el género: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.genres.index')->with('error', 'Error al eliminar el género: ' . $e->getMessage());
        }
    }
}

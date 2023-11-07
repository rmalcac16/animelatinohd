<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use DataTables;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'category_name' => 'animes',
            'page_name' => 'listAnime',
        ];
        return view('admin.animes.list')->with($data);
    }

    public function list()
    {
        $animes = Anime::query()->orderBy('id', 'desc');
        return DataTables::eloquent($animes)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::orderBy('title', 'asc')->get();
        $data = [
            'category_name' => 'animes',
            'page_name' => 'create',
            'genres' => $genres
        ];
        return view('admin.animes.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'name_alternative' => 'nullable|string|max:255',
                'type' => 'required|in:TV,Movie,Special,Ova,Ona',
                'status' => 'required|boolean',
                'banner' => 'nullable|string|max:255',
                'poster' => 'nullable|string|max:255',
                'overview' => 'nullable|string',
                'aired' => 'nullable|date',
                'premiered' => 'nullable|string|max:255',
                'broadcast' => 'required|in:1,2,3,4,5,6,7',
                'generos' => 'nullable|string|max:255',
                'rating' => 'nullable|string|max:255',
                'popularity' => 'nullable|numeric|min:0',
                'vote_average' => 'nullable|numeric|min:0|max:10',
                'trailer' => 'nullable|string|max:255',
                'slug_flv' => 'nullable|string|max:255',
                'slug_tio' => 'nullable|string|max:255',
                'slug_jk' => 'nullable|string|max:255',
                'slug_monos' => 'nullable|string|max:255',
                'slug_fenix' => 'nullable|string|max:255',
            ]);
            $anime = new Anime();
            $anime->name = $request->input('name');
            $anime->slug = Str::slug($request->name);
            $anime->name_alternative = $request->input('name_alternative');
            $anime->type = $request->input('type');
            $anime->status = $request->input('status');
            $anime->banner = $request->input('banner');
            $anime->poster = $request->input('poster');
            $anime->overview = $request->input('overview');
            $anime->aired = $request->input('aired');
            $anime->premiered = $request->input('premiered');
            $anime->broadcast = $request->input('broadcast');
            $anime->rating = $request->input('rating');
            $anime->popularity = $request->input('popularity');
            $anime->vote_average = $request->input('vote_average') ?? 0;
            $anime->trailer = $request->input('trailer');
            $anime->slug_flv = $request->input('slug_flv');
            $anime->slug_tio = $request->input('slug_tio');
            $anime->slug_jk = $request->input('slug_jk');
            $anime->slug_monos = $request->input('slug_monos');
            $anime->slug_fenix = $request->input('slug_fenix');

            $genres = $request->input('genres');
            if (!empty($genres)) {
                $anime->genres = implode(',', $genres);
            }

            $anime->save();
            return redirect()->route('admin.animes.index')->with('success', '¡El anime se ha creado correctamente!');
        } catch (Exception $e) {
            return redirect()->route('admin.animes.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anime $anime)
    {
        $genres = Genre::orderBy('title', 'asc')->get();
        $data = [
            'category_name' => 'animes',
            'page_name' => 'create',
            'genres' => $genres,
            'anime' => $anime
        ];
        return view('admin.animes.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime)
    {
        try {
            $anime->name = $request->input('name');
            $anime->name_alternative = $request->input('name_alternative');
            $anime->type = $request->input('type');
            $anime->status = $request->input('status');
            $anime->banner = $request->input('banner');
            $anime->poster = $request->input('poster');
            $anime->overview = $request->input('overview');
            $anime->aired = $request->input('aired');
            $anime->premiered = $request->input('premiered');
            $anime->broadcast = $request->input('broadcast');
            $anime->rating = $request->input('rating');
            $anime->popularity = $request->input('popularity');
            $anime->vote_average = $request->input('vote_average', 0); 
            $genres = $request->input('genres');
            if (!empty($genres)) {
                $anime->genres = implode(',', $genres);
            }
            $anime->save();
            return redirect()->route('admin.animes.index')->with('success', 'Anime actualizado exitosamente.');
        } catch (Exception $e) {
            return redirect()->route('admin.animes.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {
        try {
            $anime->delete();
            return redirect()->route('admin.animes.index')->with('success', 'Anime eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al eliminar el género. Por favor, inténtalo de nuevo.');
        }
    }
}

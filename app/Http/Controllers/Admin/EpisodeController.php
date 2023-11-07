<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Anime;
use Illuminate\Http\Request;

use Exception;
use QueryException;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($anime_id)
    {
        // Buscar el anime por su ID
        $anime = Anime::find($anime_id);

        // Obtener los episodios del anime ordenados por número de forma descendente
        $episodes = Episode::where('anime_id', $anime_id)
            ->orderByDesc('number')
            ->get();

        // Preparar los datos para la vista
        $data = [
            'category_name' => 'animes',
            'page_name' => 'list',
            'anime' => $anime,
            'episodes' => $episodes,
        ];

        // Retornar la vista de la lista de episodios con los datos
        return view('admin.episodes.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $animeId = $request->anime_id;

        // Buscar el anime por su ID
        $anime = Anime::find($animeId);

        // Preparar los datos para la vista
        $data = [
            'category_name' => 'animes',
            'page_name' => 'list',
            'anime' => $anime
        ];

        // Retornar la vista de la lista de episodios con los datos
        return view('admin.episodes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $anime_id)
    {
        try {
            // Validar los datos del formulario antes de guardarlos en la base de datos
            $request->validate([
                'number' => 'required|integer|min:0|unique:episodes,number,NULL,id,anime_id,' . $anime_id
            ]);
    
            // Crear un nuevo episodio con los datos del formulario
            $episode = new Episode();
            $episode->number = $request->input('number');
            $episode->anime_id = $anime_id;
            $episode->save();
    
            // Redireccionar a la lista de episodios del anime
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('success', 'El episodio se agregó correctamente.');
    
        } catch (QueryException $e) {
            // Si hay un error en la consulta a la base de datos, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al agregar el episodio: ' . $e->getMessage());
    
        } catch (Exception $e) {
            // Para cualquier otro tipo de excepción, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al agregar el episodio: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($anime_id, Episode $episode)
    {
        // Buscar el anime por su ID
        $anime = Anime::find($anime_id);

        // Buscar el episodio por su ID y asociarlo al anime
        $episode = Episode::where('anime_id', $anime_id)
            ->find($episode->id);

        // Verificar si se encontró el episodio
        if (!$episode) {
            abort(404, 'El episodio no fue encontrado.');
        }

        // Preparar los datos para la vista
        $data = [
            'category_name' => 'animes',
            'page_name' => 'edit_episode',
            'anime' => $anime,
            'episode' => $episode,
        ];

        // Retornar la vista de edición de episodios con los datos
        return view('admin.episodes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $anime_id, Episode $episode)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'number' => 'required|integer|min:0|unique:episodes,number,NULL,id,anime_id,' . $anime_id
            ]);

            // Actualizar el número del episodio
            $episode->number = $request->input('number');
            $episode->save();
    
            // Redireccionar a la lista de episodios con un mensaje de éxito
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])->with('success', 'Número de episodio actualizado correctamente.');
        } catch (QueryException $e) {
            // Si hay un error en la consulta a la base de datos, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al editar el episodio: ' . $e->getMessage());
    
        } catch (Exception $e) {
            // Para cualquier otro tipo de excepción, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al editar el episodio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($anime_id, Episode $episode)
    {
        try {
            // Eliminar el episodio de la base de datos
            $episode->delete();
            // Redireccionar a la lista de episodios con un mensaje de éxito
            return redirect()->route('admin.animes.episodes.index', $anime_id)->with('success', 'Episodio eliminado correctamente.');
        } catch (QueryException $e) {
            // Si hay un error en la consulta a la base de datos, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al eliminar el episodio: ' . $e->getMessage());
    
        } catch (Exception $e) {
            // Para cualquier otro tipo de excepción, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])
                             ->with('error', 'Error al eliminar el episodio: ' . $e->getMessage());
        }
    }
}

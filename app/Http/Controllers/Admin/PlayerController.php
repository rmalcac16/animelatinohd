<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\Server;
use Illuminate\Http\Request;

use QueryException;
use Exception;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($anime_id, $episode_id)
    {
        try {
            $anime = Anime::findOrFail($anime_id);
            $episode = Episode::findOrFail($episode_id);
            $players = Player::select('players.*', 'servers.*', 'players.id as playerId')
                ->where('episode_id', $episode_id)
                ->join('servers', 'players.server_id', '=', 'servers.id')
                ->get();
            $data = [
                'category_name' => 'animes',
                'page_name' => 'listAnime',
                'anime' => $anime,
                'episode' => $episode,
                'players' => $players,
            ];
            return view('admin.players.list')->with($data);
        } catch (QueryException $e) {
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])->with('error', 'Error al obtener la lista de players: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])->with('error', 'Error al obtener la lista de players: ' . $e->getMessage());
        }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($anime_id, $episode_id)
    {
        try {
            $anime = Anime::findOrFail($anime_id);
            $episode = Episode::findOrFail($episode_id);
            $servers = Server::all();
            $data = [
                'category_name' => 'animes',
                'page_name' => 'listAnime',
                'anime' => $anime,
                'episode' => $episode,
                'servers' => $servers,
            ];
            return view('admin.players.create')->with($data);
        } catch (QueryException $e) {
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])->with('error', 'Error al crear un nuevo player: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.animes.episodes.index', ['anime_id' => $anime_id])->with('error', 'Error al crear un nuevo player: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $anime_id, $episode_id)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'server_id' => 'required',
                'code' => 'required',
                'languaje' => 'required|in:0,1',
            ]);

            // Crear un nuevo player y guardar en la base de datos
            $player = new Player();
            $player->episode_id = $episode_id;
            $player->server_id = $request->server_id;
            $player->code = $request->code;
            $player->languaje = $request->languaje;
            $player->save();
            

            // Redireccionar a la lista de players con un mensaje de éxito
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('success', 'Player agregado correctamente');
        } catch (QueryException $e) {
            // Si hay un error en la consulta a la base de datos, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('error', 'Error al agregar el player: ' . $e->getMessage());

        } catch (Exception $e) {
            // Para cualquier otro tipo de excepción, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('error', 'Error al agregar el player: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($anime_id, $episode_id, Player $player)
    {
        try {
            $anime = Anime::findOrFail($anime_id);
            $episode = Episode::findOrFail($episode_id);

            $servers = Server::all(); // Asegúrate de importar el modelo Server si no lo has hecho

            // Si el player no pertenece al episodio dado, lanzar una excepción
            if ($player->episode_id !== $episode->id) {
                throw new Exception('El player especificado no pertenece al episodio dado.');
            }

            $data = [
                'category_name' => 'animes',
                'page_name' => 'list',
                'anime' => $anime,
                'episode' => $episode,
                'player' => $player,
                'servers' => $servers,
            ];

            return view('admin.players.edit', $data);
        } catch (QueryException $e) {
            return redirect()->route('admin.animes.index')->with('error', 'Error al editar el player: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.animes.index')->with('error', 'Error al editar el player: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $anime_id, $episode_id, Player $player)
    {
        try {
            // Buscar el anime y episodio asociados al player
            $anime = Anime::findOrFail($anime_id);
            $episode = Episode::findOrFail($episode_id);

            // Validar que el player pertenezca al episodio dado
            if ($player->episode_id !== $episode->id) {
                throw new Exception('El player especificado no pertenece al episodio dado.');
            }

            // Validar los datos del formulario
            $request->validate([
                'server_id' => 'required|exists:servers,id',
                'code' => 'required',
                'languaje' => 'required|in:0,1',
            ]);

            // Actualizar los datos del player con los datos del formulario
            $player->update([
                'server_id' => $request->input('server_id'),
                'code' => $request->input('code'),
                'languaje' => $request->input('languaje'),
            ]);

            // Redireccionar a la lista de players con un mensaje de éxito
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id])
                ->with('success', 'Player actualizado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id])
                ->with('error', 'Error al actualizar el player: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime->id, 'episode_id' => $episode->id])
                ->with('error', 'Error al actualizar el player: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($anime_id, $episode_id, Player $player)
    {
        try {
            // Eliminar el player de la base de datos
            $player->delete();

            // Redireccionar a la lista de players con un mensaje de éxito
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('success', 'Player eliminado correctamente');
        } catch (QueryException $e) {
            // Si hay un error en la consulta a la base de datos, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('error', 'Error al eliminar el player: ' . $e->getMessage());
        } catch (Exception $e) {
            // Para cualquier otro tipo de excepción, mostrar mensaje de error y redireccionar
            return redirect()->route('admin.animes.episodes.players.index', ['anime_id' => $anime_id, 'episode_id' => $episode_id])
                ->with('error', 'Error al eliminar el player: ' . $e->getMessage());
        }
    }
}

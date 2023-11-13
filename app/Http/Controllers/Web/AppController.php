<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Support\Facades\Crypt;

use DB;
use App\Models\Anime;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Player;

class AppController extends Controller
{
    
    protected $episode, $anime, $genre, $player, $server, $user;	

	public function __construct(Episode $episode, Anime $anime, Genre $genre, Player $player)
	{
        $this->anime = $anime;
		$this->episode = $episode;
		$this->player = $player;
		$this->genre = $genre;
	}

    public function getHome()
	{
        $data = [];
		try {
            $episodes = $this->episode->getReleases();
            $data = [
                'episodes' => $episodes
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.home')->with($data);
    }

	public function getAnimesList(Request $request)
	{
        $data = [];
		try {
            $animes = $this->anime->web_animesListaFiltro($request);
			$genres = $this->genre->web_obtenerGeneros();
            $data = [
                'animes' => $animes,
				'title' => 'Listado de Animes',
				'subtitle' => 'Disfruta de tus animes favoritos totalmente gratis',
				'filter' => true,
				'pagination' => false,
				'genres' => $genres
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.animes')->with($data);
    }

	public function getAnimesLatinoList(Request $request)
	{
        $data = [];
		try {
            $animes = $this->anime->web_animesLatinoFiltro($request);
			$genres = $this->genre->web_obtenerGeneros();
            $data = [
                'animes' => $animes,
				'title' => 'Animes en Español Latino',
				'subtitle' => 'Disfruta de tus animes doblados en un solo lugar',
				'filter' => true,
				'pagination' => true,
				'genres' => $genres
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.animes')->with($data);
    }


	public function getAnimesMoreViewList()
	{
        $data = [];
		try {
            $animes = $this->anime->web_animesMasVistos();
            $data = [
                'animes' => $animes,
				'title' => 'Animes Más Vistos',
				'subtitle' => 'Los animes más vistos por nuestros usuarios',
				'filter' => false,
				'pagination' => false
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.animes')->with($data);
    }

	public function getAnimesPopularList()
	{
        $data = [];
		try {
            $animes = $this->anime->web_animesPopulares();
            $data = [
                'animes' => $animes,
				'title' => 'Animes Populares',
				'subtitle' => 'Los animes más populares de todos los tiempos',
				'filter' => false,
				'pagination' => false
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.animes')->with($data);
    }

	public function getCalendarAnimes(Request $request)
	{
        $data = [];
		try {
            $animes = $this->anime->getCalendarAnimes($request);
            $data = [
                'animes' => $animes,
				'title' => 'Calendario de animes',
				'subtitle' => 'Consulta los dias de estreno de tus animes favoritos',
				'filter' => false,
				'pagination' => false
            ];
		} catch (Exception $e) {
			return array(
	            'msg' => $e->getMessage()
	        );
		}
        return view('web.calendar')->with($data);
    }


	public function getEpisode(Request $request, string $slug, int $number): \Illuminate\View\View
	{
		try {
			$episode = $this->episode->getEpisode($slug, $number);
			$data = [
				'episode' => $episode
			];
			DB::unprepared('update episodes set views = views+1 where id = '.$episode->id.'');
			return view('web.episode')->with($data);
		} catch (Exception $e) {
			return abort(404);
		}
    }


	public function getAnime(Request $request): \Illuminate\View\View
	{
		try {
			$anime = $this->anime->web_obtenerAnime($request->anime);
			if(!$anime)
				throw new Exception("Anime no encontrado", 1);
			$episodes = $this->episode->web_obtenerEpisodiosAnime($anime->id);
			$data = [
				'anime' => $anime,
				'episodes' => $episodes
			];
			DB::unprepared('update animes set views = views+1 where id = '.$anime->id.'');
			return view('web.anime')->with($data);
		} catch (Exception $e) {
			return abort(404);
		}
    }


	protected function showVideo(Request $request)
	{
		try {
			if(!$request->get('_token'))
				abort('403',"Se necesita el token");
			$providedToken = $request->get('_token');
			$storedToken = csrf_token();
			if ($providedToken === $storedToken) {
				$referer = $_SERVER['HTTP_REFERER'] ?? null;
				if(!$referer)
					abort(403, "No tienes acceso a esta zona");
				$parse = parse_url($referer);
				if($parse['host'] != parse_url(config('app.url'))['host'])
					abort(403, "No tienes acceso a esta zona");
				$player = $this->player->web_obtenerReproductor($request->id);
				if($player->server->embed)
					return redirect(str_replace(getDomain($player->code), $player->server->embed, $player->code));
				else 
					return redirect($player->code);
			} else {
				abort(403, "Token CSRF inválido.");
			}
		} catch (HttpResponseException $e) {
			abort($e->getResponse()->getStatusCode(), $e->getResponse()->getContent());
		}
    }

	protected function manifest(){
		return array(
			'short_name' => config('app.name'),
			'name' => config('app.name'),
			'icons' => array(
				array(
					'src' => asset('images/logo-512x512.png'),
					'type' => 'image/png',
					'sizes' => '512x512'
				),
				array(
					'src' => asset('images/logo-192x192.png'),
					'type' => 'image/png',
					'sizes' => '192x192'
				),
				array(
					'src' => asset('images/logo-64x64.png'),
					'type' => 'image/png',
					'sizes' => '64x64'
				),
			),
			'start_url' => '.',
			'display' =>  'standalone',
			'theme_color' => '#000000',
			'background_color' => '#ffffff'
		);
	}

}

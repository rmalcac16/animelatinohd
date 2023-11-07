<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Support\Facades\Crypt;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Player;
//use App\Models\Server;
//use App\Models\User;

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


	public function getEpisode(Request $request)
	{
		try {
			$anime = $this->anime->web_obtenerAnime($request->anime);
			if(!$anime)
				throw new Exception("Anime no encontrado", 1);
			$episode = $this->episode->web_obtenerEpisodio($anime->id, $request->episode);
			if(!$episode)
				throw new Exception("Episodio no encontrado", 1);
			$episodeN = $this->episode->web_obtenerEpisodio($anime->id, $request->episode + 1);
			$episodeA = $this->episode->web_obtenerEpisodio($anime->id, $request->episode - 1);
			$players = $this->player->web_obtenerReproductores($episode->id);

			if(!$this->isMobileDevice()){
				$players = $players->filter(function ($player) {
					return $player->server->title !== 'Gamma';
				})->values();
			};

			$players = $players->map(function ($player) {
				$playerWithoutCode = clone $player;
				unset($playerWithoutCode->code);
				return $playerWithoutCode;
			});

			$data = [
				'anime' => $anime,
				'episode' => $episode,
				'episodeN' => $episodeN,
				'episodeA' => $episodeA,
				'players' => $players
			];
			
			return view('web.episode')->with($data);

		} catch (Exception $e) {
			abort(404,$e->getMessage());
		}
    }


	public function getAnime(Request $request)
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
		
			return view('web.anime')->with($data);

		} catch (Exception $e) {
			return $e;
		}
    }


	public function showVideo(Request $request)
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
				return redirect($player->code);
			} else {
				abort(403, "Token CSRF inválido.");
			}
		} catch (HttpResponseException $e) {
			abort($e->getResponse()->getStatusCode(), $e->getResponse()->getContent());
		}
    }

	private function isMobileDevice()
	{
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$mobileKeywords = [
			'mobile', 'android', 'iphone', 'ipod', 'blackberry',
			'webos', 'opera mini', 'windows phone', 'iemobile',
		];
		foreach ($mobileKeywords as $keyword) {
			if (stripos($userAgent, $keyword) !== false) {
				return true;
			}
		}
		return false;
	}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Rennokki\QueryCache\Traits\QueryCacheable;

class Episode extends Model
{
    use HasFactory;
    use QueryCacheable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
	public $timestamps = false; 
	public $updated_at = true;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'anime_id' => 'integer',
    ];

    public function anime() {
        return $this->belongsTo(Anime::class);
    }

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function getReleases()
    {
        return $this
            ->select('animes.name', 'animes.slug','animes.banner', 'animes.poster', 'episodes.number', 'players.languaje', 'players.created_at')
            ->leftJoin('players','players.episode_id','episodes.id')
            ->leftJoin('animes', 'animes.id', 'episodes.anime_id')
            ->where('animes.status', 1)
            ->groupBy('players.languaje', 'episodes.id')
		    ->orderBy('players.id', 'desc')
            ->limit(30)
			->get();
    }

    public function getEpisode($slug_anime, $number)
    {
        $episode = $this
            ->select('episodes.*', 'anime_id', 'animes.name', 'animes.slug', 'animes.banner', 'animes.poster')
            ->join('animes','animes.id','episodes.anime_id')
            ->where('animes.slug', $slug_anime)
            ->where('episodes.number', $number)
            ->with(['players' => function ($query) {
                $query->select('id','server_id','episode_id','languaje')->with(['server' => function ($query) {
                    $query->select('id','title');
                }]);
            }])
            ->first();
            
        $previousEpisode = $this
            ->select('id','number')
            ->where('anime_id', $episode->anime_id)
            ->where('number', '<', $episode->number)
            ->orderBy('number', 'desc')
            ->first();

        $nextEpisode = $this
            ->select('id','number')
            ->where('anime_id', $episode->anime_id)
            ->where('number', '>', $episode->number)
            ->orderBy('number', 'asc')
            ->first();

        $episode->previousEpisode = $previousEpisode;
        $episode->nextEpisode = $nextEpisode;

        $episode->dataPlayers = collect($episode->players)->groupBy('languaje');

        return $episode;
    }

    public function web_obtenerEpisodio($anime_id, $number)
    {
        return $this
            ->join('animes','animes.id','episodes.anime_id')
            ->where('anime_id', $anime_id)
            ->where('number', $number)
            ->first();
    }

    public function web_obtenerEpisodiosAnime($anime_id)
    {
        return $this
            ->select('episodes.*', 'animes.name', 'animes.slug', 'animes.banner', 'animes.poster')
            ->join('animes','animes.id','episodes.anime_id')
            ->where('animes.id', $anime_id)
            ->orderBy('episodes.number', 'desc')
            ->get();
    }
	

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Models\Anime;
use App\Models\Episode;

class DashboardController extends Controller
{

    protected $episode, $anime, $admin;

    public function __construct(Episode $episode, Anime $anime, Admin $admin)
	{
		$this->episode = $episode;
		$this->anime = $anime;
		$this->user = $admin;
	}

    public function index(Request $request)
    {

		$data = [
            'category_name' => 'dashboard',
            'page_name' => 'index',
        ];

        return view('admin.dashboard')->with($data);
    }
    
}
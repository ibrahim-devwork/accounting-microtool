<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->middleware('auth');
        $this->homeRepository = $homeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $processList = $this->homeRepository->getAll();
            return view('home', compact('processList'));
        
        } catch(\Exception $error) {
            Log::error('HomeController - (index) : ' . $error->getMessage());
        }
    }

    public function search(Request $request) {
        try {
            $data        = $request->only('search');
            $processList = $this->homeRepository->getBySearch($data);
            return view('home', ['processList' => $processList, 'search' => $data['search']]);

        } catch(\Exception $error) {
            Log::error('HomeController - (search) : ' . $error->getMessage());
        }
    }

    public function download($file)
    {
        try {
            $path = storage_path('files/' . $file); 

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response("This file (" . $file . ") not found <a href='/home'>Back</a>", 404);
        }
        
        } catch(\Exception $error) {
            Log::error('HomeController - (download) : ' . $error->getMessage());
        }
    }
}

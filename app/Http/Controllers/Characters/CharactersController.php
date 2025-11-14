<?php

namespace App\Http\Controllers\Characters;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class CharactersController extends Controller
{
    public function index(Request $request): Response
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $response = Http::get('https://thesimpsonsapi.com/api/characters?page=' . $page);
        $characters = json_decode($response, true);

        return Inertia::render('Characters/Index', [
            'charactersData' => $characters,
            'currentPage' => $page,
            'propTest' => 'Esto es un texto de prueba',
        ]);
    }
}

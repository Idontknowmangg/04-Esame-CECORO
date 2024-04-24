<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainContent\v1\DocResource;
use App\Http\Resources\MainContent\v1\FilmResource;
use App\Http\Resources\MainContent\v1\SerieTVResource;
use App\Models\ImpostazioniAdmin\Contatti;
use App\Models\MainContent\Documentari;
use App\Models\MainContent\Film;
use App\Models\MainContent\SerieTV;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContattiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        // Recuperiamo l'utente attualmente autenticato
        $user = JWTAuth::parseToken()->authenticate();
    
        // Estraiamo i film, le serie TV e i documentari per appunto dimostrare che è la home
        $films = Film::all();
        $series = SerieTV::all();
        $documentaries = Documentari::all();
    
        // Trasformiamo i dati utilizzando le Resource create, praticamente stiamo filtrando per visualizzare solamente i dati necessari
        $filmsResource = FilmResource::collection($films);
        $seriesResource = SerieTVResource::collection($series);
        $documentariesResource = DocResource::collection($documentaries);
    
        // Infine ritorniamo le liste di ciascun formato, films, serie tv e documentari
        return response()->json([
            'All films: ' => $filmsResource,
            'All TV series: ' => $seriesResource,
            'All documentaries: ' => $documentariesResource
        ]);
    }
}

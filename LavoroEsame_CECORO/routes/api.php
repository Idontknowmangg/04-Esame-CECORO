<?php

use App\Http\Controllers\Api\v1\AssistenzaAutorizzatiController;
use App\Http\Controllers\Api\v1\AttoriController;
use App\Http\Controllers\Api\v1\ContattiAuthController;
use App\Http\Controllers\Api\v1\ContattiController;
use App\Http\Controllers\Api\v1\CreditiController;
use App\Http\Controllers\Api\v1\DocumentariController;
use App\Http\Controllers\Api\v1\DocumentarioHasGenereController;
use App\Http\Controllers\Api\v1\FilmController;
use App\Http\Controllers\Api\v1\FilmHasGenereController;
use App\Http\Controllers\Api\v1\FittizioPagamentoController;
use App\Http\Controllers\Api\v1\GenereController;
use App\Http\Controllers\Api\v1\ImpostazioniUtenteController;
use App\Http\Controllers\Api\v1\NazioniController;
use App\Http\Controllers\Api\v1\SerieTVController;
use App\Http\Controllers\Api\v1\SerieTVHasGenereController;
use App\Http\Controllers\Api\v1\ValutazioneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

if (!defined('_VERS')) {
    define('_VERS', 'v1');
}

// APIs for everyone (guests)

Route::post(_VERS . '/register', [ContattiAuthController::class, 'register']);
Route::post(_VERS . '/login', [ContattiAuthController::class, 'login']);


// APIs for authorized users
Route::group(['middleware' => ['auth:api', 'checkJWT', 'isBanned', 'throttle:150,5']], function () {
Route::get(_VERS . '/home', [ContattiController::class, 'index']);
Route::get(_VERS . '/home/actors', [AttoriController::class, 'index']);
Route::get(_VERS . '/home/actors/{idAttore}', [AttoriController::class, 'show']);

// Films
Route::get(_VERS . '/home/all_films', [FilmController::class, 'index']);
Route::get(_VERS . '/home/all_films/{idFilm}', [FilmController::class, 'show']);
Route::get(_VERS . '/home/all_films/{idFilm}/play', [FilmController::class, 'play']);

// TV Series
Route::get(_VERS . '/home/all_tvSeries', [SerieTVController::class, 'index']);
Route::get(_VERS . '/home/all_tvSeries/list', [SerieTVController::class, 'listEpisodes']);
Route::get(_VERS . '/home/all_tvSeries/list/{idSerieTV}', [SerieTVController::class, 'listEpisodesSHOW']);
Route::get(_VERS . '/home/all_tvSeries/list/{idSerieTV}/play', [SerieTVController::class, 'play']);
Route::get(_VERS . '/home/all_tvSeries/{idSerieTV}', [SerieTVController::class, 'show']);

// Documentaries
Route::get(_VERS . '/home/all_docs', [DocumentariController::class, 'index']);
Route::get(_VERS . '/home/all_docs/{idDocumentario}', [DocumentariController::class, 'show']);
Route::get(_VERS . '/home/all_docs/{idDocumentario}/play', [DocumentariController::class, 'play']);

// Settings
Route::get(_VERS . '/home/settings', [ImpostazioniUtenteController::class, 'index']);
Route::put(_VERS . '/home/settings', [ImpostazioniUtenteController::class, 'update']);
Route::get(_VERS . '/home/settings/credits', [CreditiController::class, 'index']);

// Website tools
Route::post(_VERS . '/home/help', [AssistenzaAutorizzatiController::class, 'store']);
Route::post(_VERS . '/home/feedback', [ValutazioneController::class, 'store']);
Route::post(_VERS . '/home/reservedAreaForUsers', [FittizioPagamentoController::class, 'store']);
Route::put(_VERS . '/home/buyCredits', [CreditiController::class, 'buyCreditsUser']);
Route::get(_VERS . '/home/logout', [ContattiAuthController::class, 'logout']);
Route::delete(_VERS . '/home/destroy', [ContattiAuthController::class, 'deletePermanent']);
});


// For admin user
Route::group(['middleware' => ['auth:api', 'checkJWT', 'checkAdmin', 'isBanned', 'throttle:150,5']], function () {
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_users', [ImpostazioniUtenteController::class, 'showList']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_users/{idUtente}', [ImpostazioniUtenteController::class, 'chooseList']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_users', [ImpostazioniUtenteController::class, 'storeList']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_users/{idUtente}', [ImpostazioniUtenteController::class, 'updateList']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_users/{idUtente}', [ImpostazioniUtenteController::class, 'deleteList']);

Route::post(_VERS . '/home/all_films', [FilmController::class, 'store']);
Route::put(_VERS . '/home/all_films/{idFilm}', [FilmController::class, 'update']);
Route::delete(_VERS . '/home/all_films/{idFilm}', [FilmController::class, 'destroy']);

Route::post(_VERS . '/home/all_docs', [DocumentariController::class, 'store']);
Route::put(_VERS . '/home/all_docs/{idDocumentario}', [DocumentariController::class, 'update']);
Route::delete(_VERS . '/home/all_docs/{idDocumentario}', [DocumentariController::class, 'destroy']);

Route::post(_VERS . '/home/all_tvSeries', [SerieTVController::class, 'store']);
Route::put(_VERS . '/home/all_tvSeries/{idSerieTV}', [SerieTVController::class, 'update']);
Route::delete(_VERS . '/home/all_tvSeries/{idSerieTV}', [SerieTVController::class, 'destroy']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_genres', [GenereController::class, 'showGenres']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_genres/{idGenere}', [GenereController::class, 'chooseGenres']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_genres', [GenereController::class, 'storeGenres']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_genres/{idGenere}', [GenereController::class, 'updateGenres']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_genres/{idGenere}', [GenereController::class, 'deleteGenres']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_nations', [NazioniController::class, 'showNazioni']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_nations/{idNazione}', [NazioniController::class, 'chooseNazioni']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_nations', [NazioniController::class, 'storeNazioni']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_nations/{idNazione}', [NazioniController::class, 'updateNazioni']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_nations/{idNazione}', [NazioniController::class, 'deleteNazioni']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_credits', [CreditiController::class, 'showCreditList']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_credits/{idUtente}', [CreditiController::class, 'chooseCreditList']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_credits', [CreditiController::class, 'storeCreditList']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_credits/{idUtente}', [CreditiController::class, 'updateCreditList']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_credits/{idUtente}', [CreditiController::class, 'deleteCreditList']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_docs', [DocumentarioHasGenereController::class, 'index']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_docs/{idDoc}', [DocumentarioHasGenereController::class, 'show']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_docs', [DocumentarioHasGenereController::class, 'store']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_docs/{idDoc}', [DocumentarioHasGenereController::class, 'update']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_docs/{idDoc}', [DocumentarioHasGenereController::class, 'destroy']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_films', [FilmHasGenereController::class, 'index']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_films/{idFilm}', [FilmHasGenereController::class, 'show']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_films', [FilmHasGenereController::class, 'store']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_films/{idFilm}', [FilmHasGenereController::class, 'update']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_films/{idFilm}', [FilmHasGenereController::class, 'destroy']);

Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_tvSeries', [SerieTVHasGenereController::class, 'index']);
Route::get(_VERS . '/ChrisAdminImpostazioniWebsite/list_tvSeries/{idSerieTV}', [SerieTVHasGenereController::class, 'show']);
Route::post(_VERS . '/ChrisAdminImpostazioniWebsite/list_tvSeries', [SerieTVHasGenereController::class, 'store']);
Route::put(_VERS . '/ChrisAdminImpostazioniWebsite/list_tvSeries/{idSerieTV}', [SerieTVHasGenereController::class, 'update']);
Route::delete(_VERS . '/ChrisAdminImpostazioniWebsite/list_tvSeries/{idSerieTV}', [SerieTVHasGenereController::class, 'destroy']);
});
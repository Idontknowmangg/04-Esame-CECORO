<?php

namespace App\Models\VisualizzazioneImmagini;

use App\Models\ImpostazioniSito\StagioniEpisodi;
use App\Models\MainContent\SerieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vedi_serieTV extends Model
{
    use HasFactory;
    protected $table = "vedi_serietv";
    protected $primaryKey = "idFormatoSerieTV";

    protected $fillable = [
        'percorsoSerieTV'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function serieTV()
    {
        return $this->hasOne(StagioniEpisodi::class, 'idFormatoSerieTV', 'idFormatoSerieTV');
    }
}

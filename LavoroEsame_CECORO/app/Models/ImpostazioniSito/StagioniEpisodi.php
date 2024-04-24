<?php

namespace App\Models\ImpostazioniSito;

use App\Models\MainContent\SerieTV;
use App\Models\VisualizzazioneImmagini\Vedi_serieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StagioniEpisodi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "stagioni_episodi";
    protected $primaryKey = "idStagioneEpisodio";

    protected $fillable = [
        'idSerieTV',
        'idFormatoSerieTV',
        'Stagione',
        'Episodio',
        'descrizione'
    ];

    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function SerieTV_FK()
    {
        return $this->belongsTo(SerieTV::class, 'idSerieTV', 'idSerieTV');
    }

    public function VisualizeSerieTV_FK()
    {
        return $this->belongsTo(Vedi_serieTV::class, 'idFormatoSerieTV', 'idFormatoSerieTV');
    }
}

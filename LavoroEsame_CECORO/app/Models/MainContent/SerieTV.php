<?php

namespace App\Models\MainContent;

use App\Models\Immagini\Immagini_serieTV;
use App\Models\ImpostazioniGenere\Genere;
use App\Models\ImpostazioniGenere\SerieTV_hasGenere;
use App\Models\ImpostazioniSito\CreditiSerieTV;
use App\Models\ImpostazioniSito\StagioniEpisodi;
use App\Models\VisualizzazioneImmagini\Vedi_serieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieTV extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "serie_tv";
    protected $primaryKey = "idSerieTV";

    protected $fillable = [
        'titoloSerieTV',
        'idGenere',
        'idImmagineSerieTV',
        'descrizione',
        'regista',
        'totStagioni',
        'totEp',
        'anno'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function SerieTVHasGenere()
    {
        return $this->hasMany(SerieTV_hasGenere::class, 'idSerieTV', 'idSerieTV');
    }

    public function SerieTVCrediti()
    {
        return $this->hasMany(CreditiSerieTV::class, 'idSerieTV', 'idSerieTV');
    }

    public function StagioniEpisodi()
    {
        return $this->hasMany(StagioniEpisodi::class, 'idSerieTV', 'idSerieTV');
    }
    
    
    //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function GenereFK()
    {
        return $this->belongsTo(Genere::class, 'idGenere', 'idGenere');
    }

    public function immaginiSerieTV_FK()
    {
        return $this->belongsTo(Immagini_serieTV::class, 'idImmagineSerieTV', 'idImmagineSerieTV');
    }
}

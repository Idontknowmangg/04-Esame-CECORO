<?php

namespace App\Models\ImpostazioniGenere;

use App\Models\MainContent\SerieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieTV_hasGenere extends Model
{
    use HasFactory;
    protected $table = "serietv_has_genere";
    protected $primaryKey = "idTracciaSerieTV";

    protected $fillable = [
        'idSerieTV',
        'idGenere'
    ];


        //       ---------------------------    FK    ---------------------------


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

    public function GenereFK()
    {
        return $this->belongsTo(Genere::class, 'idGenere', 'idGenere');
    }
}

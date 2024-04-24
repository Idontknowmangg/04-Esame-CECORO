<?php

namespace App\Models\ImpostazioniSito;

use App\Models\MainContent\SerieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditiSerieTV extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "crediti_serie_tV";
    protected $primaryKey = "idCreditiSerieTV";

    protected $fillable = [
        'idSerieTV',
        'creditiNecessari'
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
}

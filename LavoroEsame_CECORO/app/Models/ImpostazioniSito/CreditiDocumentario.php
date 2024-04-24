<?php

namespace App\Models\ImpostazioniSito;

use App\Models\MainContent\Documentari;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditiDocumentario extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "crediti_documentario";
    protected $primaryKey = "idCreditiDocumentario";

    protected $fillable = [
        'idDocumentario',
        'creditiNecessari'
    ];

    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function DocFK()
    {
        return $this->belongsTo(Documentari::class, 'idDocumentario', 'idDocumentario');
    }
}

<?php

namespace App\Models\ImpostazioniGenere;

use App\Models\MainContent\Documentari;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentario_hasGenere extends Model
{
    use HasFactory;
    protected $table = "documentario_has_genere";
    protected $primaryKey = "idTracciaDocumentario";

    protected $fillable = [
        'idDocumentario',
        'idGenere'
    ];



        //       ---------------------------    FK    ---------------------------


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

    public function GenereFK()
    {
        return $this->belongsTo(Genere::class, 'idGenere', 'idGenere');
    }
}

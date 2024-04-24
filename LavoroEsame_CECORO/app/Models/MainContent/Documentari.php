<?php

namespace App\Models\MainContent;

use App\Models\Immagini\Immagini_documentario;
use App\Models\ImpostazioniGenere\Documentario_hasGenere;
use App\Models\ImpostazioniGenere\Genere;
use App\Models\ImpostazioniSito\CreditiDocumentario;
use App\Models\VisualizzazioneImmagini\Vedi_documentario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentari extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "documentari";
    protected $primaryKey = "idDocumentario";

    protected $fillable = [
        'titoloDocumentario',
        'idGenere',
        'idImmagineDocumentario',
        'idFormatoDocumentario',
        'descrizione',
        'regista',
        'anno',
        'durata'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function DocHasGenere()
    {
        return $this->hasMany(Documentario_hasGenere::class, 'idDocumentario', 'idDocumentario');
    }

    public function DocCrediti()
    {
        return $this->hasMany(CreditiDocumentario::class, 'idDocumentario', 'idDocumentario');
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

    public function immaginiDocumentarioFK()
    {
        return $this->belongsTo(Immagini_documentario::class, 'idImmagineDocumentario', 'idImmagineDocumentario');
    }

    public function vediDocumentarioFK()
    {
        return $this->belongsTo(Vedi_documentario::class, 'idFormatoDocumentario', 'idFormatoDocumentario');
    }
}

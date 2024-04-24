<?php

namespace App\Models\VisualizzazioneImmagini;

use App\Models\MainContent\Documentari;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vedi_documentario extends Model
{
    use HasFactory;
    protected $table = "vedi_documentario";
    protected $primaryKey = "idFormatoDocumentario";

    protected $fillable = [
        'percorsoDocumentario'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function documentari()
    {
        return $this->hasOne(Documentari::class, 'idFormatoDocumentario', 'idFormatoDocumentario');
    }
}

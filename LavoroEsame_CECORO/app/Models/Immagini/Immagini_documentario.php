<?php

namespace App\Models\Immagini;

use App\Models\MainContent\Documentari;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Immagini_documentario extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "immagini_documentario";
    protected $primaryKey = "idImmagineDocumentario";

    protected $fillable = [
        'percorsoImmagineDocumentario'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function documentari()
    {
        return $this->hasOne(Documentari::class, 'idImmagineDocumentario', 'idImmagineDocumentario');
    }
}

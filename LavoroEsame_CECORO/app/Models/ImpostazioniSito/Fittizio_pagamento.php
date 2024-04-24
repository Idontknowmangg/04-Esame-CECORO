<?php

namespace App\Models\ImpostazioniSito;

use App\Models\ImpostazioniAdmin\Contatti;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fittizio_pagamento extends Model
{
    use HasFactory;
    protected $table = "fittizio_pagamento";
    protected $primaryKey = "idPagamento";

    protected $fillable = [
        'idContatto',
        'personal_info'
    ];

    //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function contattiFK()
    {
        return $this->belongsTo(Contatti::class, 'idContatto', 'idContatto');
    }
}

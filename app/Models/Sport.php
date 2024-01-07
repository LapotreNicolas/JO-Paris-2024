<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $casts = [
        'nom' => 'string',
        'description' => 'string',
        'annee_ajout' => 'integer',
        'nb_disciplines' => 'integer',
        'nb_epreuves' => 'integer',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'url_media' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    function athletes() {
        return $this->belongsToMany(Athlete::class, 'classement')
            ->as('classement')
            ->withPivot('rang', 'performance')
            ->orderBy('rang');
    }
}

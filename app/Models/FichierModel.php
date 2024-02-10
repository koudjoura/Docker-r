<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichierModel extends Model
{
    protected $table = 'fichiers'; // Assurez-vous que cela correspond à la table dans votre base de données
    protected $fillable = ['name', 'fichier'];
}

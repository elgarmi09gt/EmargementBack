<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $Matricule
 * @property string $Prenom
 * @property string $Nom
 * @property string $PhoneNumber
 * @property string $email
 * @property Emargement[] $emargements
 */
class Employe extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['Matricule', 'Prenom', 'Nom', 'PhoneNumber', 'email'];

    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emargements()
    {
        return $this->hasMany('App\Emargement', 'Matricule', 'Matricule');
    }
}

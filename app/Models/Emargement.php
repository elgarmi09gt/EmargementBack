<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $Matricule
 * @property string $arrived_at
 * @property string $lived_at
 * @property Employe $employe
 */
class Emargement extends Model
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
    protected $fillable = ['Matricule', 'arrived_at', 'lived_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employe()
    {
        return $this->belongsTo('App\Employe', 'Matricule', 'Matricule');
    }
}

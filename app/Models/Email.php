<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    use HasFactory;

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expediteur',
        'destinataire',
        'objet',
        'message'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, 'destinataire','user_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classes::class, 'destinataire');
    }

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';

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
        'message',
        'statut'
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

    public function classe()
    {
        return $this->belongsTo(Classes::class, 'destinataire');
    }

    public function expediteurs()
    {
        return $this->belongsTo(User::class, 'expediteur');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire','id');
    }
}

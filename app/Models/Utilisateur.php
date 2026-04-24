<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model
{

use HasFactory;
    protected $table = 'utilisateurs';
    protected $primaryKey = 'code_user';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'code_user',
        'nom_user',
        'prenom_user',
        'login_user',
        'password_user',
        'tel_user',
        'sexe_user',
        'role_user',
        'etat_user',
    ];

    // Hasher le mot de passe avant d'enregistrer
    public function setPasswordUserAttribute($value)
    {
        $this->attributes['password_user'] = Hash::make($value);
    }
    function interventions()
    {
        return $this->hasMany(Intervention::class, 'code_user', 'code_user');
    }


    function competences()
    {
        
        return $this->belongsToMany(Competence::class, 'user_competences', 'code_user', 'code_comp');
    }

    public function userCompetences()
    {
        return $this->hasMany(User_Competence::class, 'code_user', 'code_user');
    }
}

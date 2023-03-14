<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\PipelineService;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory,HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pipelines()
        {
            return $this->hasMany(Pipeline::class);
        }

    public function canAccessFilament(): bool
        {
            return true;
            #return $this->hasAnyRole(['super-admin', 'admin']);
        }

        // public function aftersave()
        // {
        //     // Perform some actions after the model has been saved
        //         // dd($this->password);
        //         $response=PipelineService::createUser($this->value,$this->password,$this->email);
        // }

        // public function save(array $options = [])
        // {
        //     dd($this);
        //     $saved = parent::save($options);
        //     //dd($this->name);

        //     if ($saved) {
        //          $this->aftersave();
        //     }

        //     return $saved;
        // }
}

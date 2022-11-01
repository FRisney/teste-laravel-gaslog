<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\ItemNotFoundException;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
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
        'last_login' => 'datetime',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @param string $login
     * @param string $password
     * @return static
     * @throws Exception
     * @throws ItemNotFoundException
     */
    public function findByCredentials($login,$password)
    {
        $user = $this->newQuery()
            ->where('login','=',$login)
            ->get()->firstOrFail();
        if(!password_verify($password,$user->password)){
            throw new Exception('Senha Invalida');
        }
        return $user;
    }

    public function registerNewUser($login,$password,$name)
    {
        $this->password = password_hash($password,PASSWORD_BCRYPT);
        $this->login = $login;
        $this->name = $name;
        $this->last_login = new DateTime();
        $this->save();
    }

    public function updateLastLogin()
    {
        $this->last_login = new DateTime();
        $this->save();
    }
}

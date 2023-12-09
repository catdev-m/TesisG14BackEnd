<?php

namespace Memories\Auth\Domain\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Memories\Auth\Domain\Entities\UserState;

class User extends Authenticatable implements JWTSubject , Arrayable{

//    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_id';

    private $userId;
    private $user;
    private $email;
    private $emailVerifiedAt;
    private $password;
    private ?UserState $state;

    public function __construct(string $userId = null,string $user = null,string $email=null,UserState $state=null)
    {
        $this->user = $user;
        $this->email= $email;
        $this->state = $state;
        $this->userId = $userId;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        'password' => 'hashed',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }


    public function getUserId(){
        return $this->userId;
    }

    public function toArray()
    {
        return [
            "userId"=>$this->userId,
            "user"=>$this->user,
            "state"=>$this->state->toArray()
        ];
    }
}

<?php
namespace Memories\Management\Domain\Entities;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Date;
use Memories\Auth\Domain\Entities\UserState;

class TUser implements Arrayable{

    private string $userId;
    private string $name;
    private string $email;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private UserState $state;

    public function __construct(string $userId, string $name, string $email, DateTime $createdAt, ?DateTime $updatedAt= new Date(), UserState $state)
    {
        $this->userId = $userId;
        $this->name= $name;
        $this->email= $email;
        $this->createdAt=$createdAt;
        $this->updatedAt=$updatedAt;
        $this->state = $state;
    }

    function toArray()
    {
        return[
            'userId'=>$this->userId,
            'name'=>$this->name,
            'email'=>$this->email,
            'createdAt'=>$this->createdAt->format('Y-m-d h:m:s'),
            'updatedAt'=>$this->updatedAt->format('Y-m-d h:m:s'),
            'state'=>$this->state->toArray()
        ];
    }
}

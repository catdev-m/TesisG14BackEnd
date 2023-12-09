<?php
namespace Memories\Management\Domain\Entities;

use Carbon\Carbon;

class RolUser {
    private string $code;
    private string $rolId;
    private string $userId;
    private string $createdAt;

    public function __construct(string $code, string $rolId, string $userId)
    {
        $this->code= $code;
        $this->rolId = $rolId;
        $this->userId = $userId;
        $this->createdAt = Carbon::now();
    }

    public function getCode(){
        return $this->code;
    }

    public function getRolid(){
        return $this->rolId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
}

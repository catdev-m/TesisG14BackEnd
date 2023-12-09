<?php
namespace Memories\Management\Domain\Entities;

use DateTime;

class PermissionRol{
    private string $code;
    private string $rolCode;
    private string $permissionCode;
    private DateTime $createdAt;

    function __construct(string $code,string $rolCode,string $permissionCode,DateTime $createdAt)
    {
        $this->code=$code;
        $this->rolCode=$rolCode;
        $this->permissionCode=$permissionCode;
        $this->createdAt=$createdAt;
    }

    public function getCode():string{
        return $this->code;
    }

    public function getRolCode():string{
        return $this->rolCode;
    }

    public function getPermissionCode():string{
        return $this->permissionCode;
    }

    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }
}

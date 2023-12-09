<?php
namespace Memories\Management\Domain\Entities;

use Carbon\Carbon;
use DateTime;

class RolMenu{
    private $code;
    private $rolCode;
    private $menuCode;
    private $createdAt;

    public function __construct(string $code,string $rolCode,string $menuCode)
    {
        $this->code = $code;
        $this->rolCode = $rolCode;
        $this->menuCode = $menuCode;
        $this->createdAt = Carbon::now();
    }

    public function getCode():string{
        return $this->code;
    }

    public function getRolCode():string{
        return $this->rolCode;
    }
    public function getMenuCode():string{
        return $this->menuCode;
    }
    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }


}

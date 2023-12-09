<?php

namespace Memories\Management\Domain\Entities;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Permission  implements Arrayable{

    private string $code;
    private string $identifier;
    private string $name;
    private string $menu;
    private DateTime $createdAt;

    function __construct($code,$identifier,$name,$menu,$createdAt)
    {
        $this->code = $code;
        $this->identifier = $identifier;
        $this->name = $name;
        $this->menu = $menu;
        $this->createdAt = $createdAt;
    }

    public function getCode():string{
        return $this->code;
    }

    public function getIdentifier():string{
        return $this->identifier;
    }
    public function getName():string{
        return $this->name;
    }

    public function getMenu():string{
        return $this->menu;
    }

    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }

    public function toArray()
    {
        return [
            "code"=>$this->code,
            "identifier"=>$this->identifier,
            "name"=>$this->name,
            "menu"=>$this->menu,
            "createdAt"=>$this->createdAt->format('Y-m-d')
        ];

    }
}

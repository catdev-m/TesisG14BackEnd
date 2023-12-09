<?php

namespace Memories\Management\Domain\Entities;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Menu implements Arrayable{
    private string $code;
    private string $name;
    private string $url;
    private string $active;
    private DateTime $createdAt;
    private ?string $parent;
    private string $icon;

    public function __construct(string $code,string $name,string $url,bool $active,DateTime $createdAt,?string $parent,string $icon)
    {
        $this->code     = $code;
        $this->name     = $name;
        $this->url      = $url;
        $this->active   = $active;
        $this->createdAt = $createdAt;
        $this->parent = $parent;
        $this->icon=$icon;
    }

    public function getCode():string{
        return $this->code;
    }
    public function getName():string {
        return $this->name;
    }
    public function getUrl(){
        return $this->url;
    }
    public function isActive(){
        return $this->active;
    }

    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }

    public function toArray():array{
        return [
            "code"=>$this->code,
            "name"=>$this->name,
            "url"=>$this->url,
            "active"=>$this->active,
            "createdAt"=>$this->createdAt->format('d-m-Y'),
            'icon'=>$this->icon,
            'parent'=>$this->parent

        ];
    }
}

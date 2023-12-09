<?php

namespace Memories\Management\Domain\Entities;

use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class SubMenu implements Arrayable{

    private string $code;
    private string $name;
    private string $url;
    private ?string $parent;
    private DateTime $createdAt;

    public function __construct(string $code,string $name,string $url,DateTime $createdAt,?string $parent)
    {
        $this->code     = $code;
        $this->name     = $name;
        $this->url      = $url;
        $this->createdAt = $createdAt;
        $this->parent   = $parent;
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
    public function getCreatedAt():DateTime{
        return $this->createdAt;
    }
    public function getParent():string{
        return $this->parent;
    }
    
    public function toArray():array{
        return [
            "code"=>$this->code,
            "name"=>$this->name,
            "url"=>$this->url,
            "createdAt"=>$this->createdAt->format('d-m-Y'),
            "parent"=>$this->parent,
            'icon'=>'pi-database'
        ];
    }
}
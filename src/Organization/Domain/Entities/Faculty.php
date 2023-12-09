<?php
namespace Memories\Organization\Domain\Entities;

use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Support\Arrayable;

class Faculty implements Arrayable{
    private $facultyId;
    private $name;
    private $description;
    private $active;
    private $createdAt;
    private $updatedAt;

    public function __construct(string $facultyId, string $name, string $description,bool $active,DateTime $createdAt,DateTime $updatedAt)
    {
        $this->facultyId = $facultyId;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt =  $createdAt;
        $this->updatedAt= $updatedAt;
        $this->active = $active;
    }

    public function getFacultyId(){
        return $this->facultyId;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }

    public function isActive(){
        return $this->active;
    }


    public function toArray()
    {
        return [
            "facultyId"=>$this->facultyId,
            "name"=>$this->name,
            "description"=>$this->description,
            "active"=>$this->active,
            "createdAt"=>$this->createdAt->format('Y-m-d h:m:s') ,
            "updatedAt"=>$this->updatedAt->format('Y-m-d h:m:s')
        ];
    }

}

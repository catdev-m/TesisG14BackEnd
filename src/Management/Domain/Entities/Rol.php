<?php

namespace Memories\Management\Domain\Entities;
use DateTimeInterface;
use App\Models\Entity;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model {
    
    public  $rolId;
    public string $name;
    public string $description;
    public bool $active;
    public bool $editable;
    public DateTime $dateUpdated;
    public DateTime $dateCreated;

    public function __construct(string $rolId,string $name, bool $active,string $description,bool $editable,DateTime $dateCreated, DateTime $dateUpdated)
    {
        $this->rolId        = $rolId;
        $this->name         = $name;
        $this->active       = $active;
        $this->editable     = $editable;
        $this->description  = $description;
        $this->dateCreated  = $dateCreated;
        $this->dateUpdated  = $dateUpdated;
    }

    public function getRolId():string{
        return $this->rolId;
    }
    
    public function getName():string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function isActive(){
        return $this->active;
    }

    public function setIsActive(bool $active){
        $this->active = $active;
    }

    public function isEditable(){
        return $this->editable;
    }

    public function getDescription():string{
        return $this->description;
    }

    public function setDescription(string $desc){
        $this->description = $desc;
    }

    public function getDateCreated(){
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $dateCreated){
        $this->dateUpdated = $dateCreated;
    }

    public function getDateUpdated():DateTime{
        return $this->dateUpdated;
    }
    
    public function setDateUpdated(DateTime $dateUpdated){
        $this->dateUpdated= $dateUpdated;
    }

    protected function serializeDate(DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function toArray(): array
    {
        return[
            "rolId"=>$this->rolId,
            "name"=>$this->name,
            "active"=>$this->active,
            "description"=>$this->description,
            "dateCreated"=>$this->dateCreated->format('Y-m-d h:m:s'),
            "dateUpdated"=>$this->dateUpdated->format('Y-m-d h:m:s')
        ];
    }
}
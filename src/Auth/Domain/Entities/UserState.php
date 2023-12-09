<?php
namespace Memories\Auth\Domain\Entities;
use Illuminate\Contracts\Support\Arrayable;

class UserState implements Arrayable
{
    private $stateId;
    private $name;

    function __construct(string $stateId, string $name)
    {
        $this->stateId = $stateId;
        $this->name = $name;
    }

    function toArray()
    {
        return [
            "stateId"=>$this->stateId,
            "name"=>$this->name
        ];
    }
}

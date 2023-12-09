<?php
namespace Memories\Auth\Domain\Entities;
use Illuminate\Contracts\Support\Arrayable;
class Auth implements Arrayable
{
    private $email;
    private $password;

    function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    function toArray()
    {
        return [
            'email'=>$this->email,
            'password'=>$this->password
        ];
    }
}

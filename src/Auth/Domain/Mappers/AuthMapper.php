<?php

namespace Memories\Auth\Domain\Mappers;

use Exception;
use Illuminate\Http\Request;
use Memories\Auth\Domain\Entities\Auth;

class AuthMapper
{
    public static function fromRequestToEntity(Request $request):Auth{
        $email= $request->string('email');
        $pass = $request->string('password');

        if($email ==null || $pass==null )
            throw new Exception("email and password is required");

        return new Auth(
            email: $email,
            password:$pass
        );
    }
}

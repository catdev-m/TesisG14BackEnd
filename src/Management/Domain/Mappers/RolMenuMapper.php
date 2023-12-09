<?php
namespace Memories\Management\Domain\Mappers;

use Illuminate\Http\Request;
use Memories\Management\Domain\Entities\RolMenu;

class RolMenuMapper{
    public static function fromRequest(Request $request):RolMenu{
        return new RolMenu(
            code:$request->string('code'),
            rolCode: $request->string('rolCode'),
            menuCode:$request->string('menuCode')
        );
    }
}

<?php

namespace Memories\Management\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Memories\Management\Domain\Services\MenuService;

class MenuController extends BaseController{

    private ?MenuService $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function getAll(){

        $result = $this->menuService->getMenuList();
        return response()->json($result->toArray());
    }

    public function getMenusByRol(Request $request, string $rolId){
        $res = $this->menuService->getMenusByRol($rolId);

        return response()->json($res->toArray());
    }

}

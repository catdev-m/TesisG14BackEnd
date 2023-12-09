<?php

namespace Memories\Organization\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Memories\Organization\Domain\Mappers\FacultyMapper;
use Memories\Organization\Domain\Services\FacultyService;

class FacultyController extends Controller{

    private FacultyService $facultyService;

    public function __construct(FacultyService $facultyService)
    {
        $this->facultyService = $facultyService;
    }

    public function fetchFaculties(){
        $res = $this->facultyService->fetchFaculties();
        return response()->json($res->toArray());

    }

    public function createFaculty(Request $request){

        $faculty = FacultyMapper::fromRequestToEntity($request);
        $res= $this->facultyService->saveFaculty($faculty);

        return response()->json($res->toArray());
    }

    public function updateFaculty(Request $request,string $facultyId){
        $faculty = FacultyMapper::fromRequestToEntity($request);
        $res= $this->facultyService->updateFaculty($faculty);

        return response()->json($res->toArray());
    }
}

<?php
namespace Memories\Organization\Domain\Mappers;

use Illuminate\Support\Collection;
use Memories\Organization\Domain\Entities\Faculty;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FacultyMapper{

    public static function fromRawToEntity($raw):Faculty{
        return new Faculty(
            facultyId:$raw->faculty_id,
            name:$raw->name,
            description:$raw->description,
            active:$raw->active,
            createdAt:new DateTime($raw->created_at),
            updatedAt:new DateTime($raw->updated_at),
        );
    }

    public static function fromRawToCollection(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push(FacultyMapper::fromRawToEntity($item));
        }
        return $list;
    }

    public static function fromRequestToEntity(Request $req):Faculty{
        if(!$req->hasAny(["facultyId","name","description","active"]))
            throw new Exception('Bad request');

        return new Faculty(
            facultyId:$req->string('facultyId'),
            name:$req->string('name'),
            description:$req->string('description'),
            active:$req->boolean('active'),
            createdAt:Carbon::now(),
            updatedAt:Carbon::now()
        );
    }
}

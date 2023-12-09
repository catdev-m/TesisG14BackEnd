<?php

namespace App\Models;

use FFI;
use Illuminate\Database\Eloquent\Model;
use Memories\Management\Domain\Entities\Rol;

class Result{

    public string $message;
    public bool $success;
    public $data;

    public function toArray(){
        $type = gettype($this->data);
        $value= null;
        switch($type){
            case 'boolean':
                $value = $this->data;
                break;
            case 'integer':
                $value= $this->data;
                break;
            case 'string':
                $value= $this->data;
                break;
            case 'array':
                $value = array();
                foreach($this->data as $element){
                    array_push($value,$element->toArray());
                }
                break;
            case 'object':
                $value= $this->data->toArray();
                break;
        }
        
        return [
            "message"=>$this->message,
            "success"=>$this->success,
            "data"=> $value
        ];
    }
}

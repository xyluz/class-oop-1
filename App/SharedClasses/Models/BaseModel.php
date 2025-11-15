<?php

namespace App\SharedClasses\Models;

use App\SharedClasses\Database;
use InvalidArgumentException;

class BaseModel extends Database
{

    public array $data;
    protected array $fillable;
    protected string $table;

    public function setData(array $data): static{
        $this->data = $data;
        return $this;
    }

    /**
     * TODO: make this return back a user object
     * @param array|null $data
     * @return bool
     */
    public  function create(array|null $data = []): bool{

        try{
            $sql = "INSERT INTO {$this->table} ( {$this->makeColumns()} ) VALUE ( {$this->makeBindingValueString()} )";

            $this->prepare($sql);
            $this->multiBind($this->fillable,$this->cleanUpData($data));

            return $this->execute();

        }catch (\Exception | InvalidArgumentException $e){
//           dd($e);
            throw $e;
            //TODO: log the exception, and return false
        }

    }

    public function find():User{
        return new User();
    }

    public function delete($id){
        //TODO: actual db delete
    }

    public function update($id, $data){
        //TODO: implement
    }

    private function makeColumns():string{
        return implode(',',$this->fillable);
    }

    private function makeBindingValueString():string{
        return implode(',',array_map(fn ($value) => ":" . $value , array_values($this->fillable)));
    }

    private function cleanUpData(array $data):array{

       $fillable = array_flip($this->fillable);

        foreach ($data as $key => $value) {

            if(!array_key_exists($key,$fillable)){
                unset($data[$key]);
            }

        }

        return $data;

    }
}
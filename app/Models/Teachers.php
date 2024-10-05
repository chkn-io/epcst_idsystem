<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $fillable = [
        'employee_number',
        'first_name',
        'middle_name',
        'last_name',
        'picture',
        'rfid',
        'type'
    ];
    use HasFactory;


    public function getfullNameAttribute(){
        return $this->last_name .", ". $this->first_name. " ". $this->middle_name;
    }

    public function logs(){
        return $this->hasMany(Logs::class,'teachers_id');
    }

}

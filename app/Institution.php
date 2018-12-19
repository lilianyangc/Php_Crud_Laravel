<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class institution extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'institution_name',
        'student_residence',
        'street_number',
        'city',
        'province',
        'postal_code'

    ];


}

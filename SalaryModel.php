<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryModel extends Model
{
    protected $table = "salary";
    protected $fillable = [ "stuffid", "date", "amount"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patiens extends Model
{
    use HasFactory;
    protected $fillable = ["name","phone","status","alamat","in_date_at","out_date_at"];
}
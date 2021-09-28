<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "gender", "country"
    ];
}

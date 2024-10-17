<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Estado extends Model
{
    use HasFactory;

    // MUTADORES Y ACCESORES
    protected function nombre(): Attribute {
        return new Attribute(
            set: fn($name) => strtolower($name),
            get: fn($name) => ucwords($name)
        );
    }

    protected function capital(): Attribute {
        return new Attribute(
            set: fn($capital) => strtolower($capital),
            get: fn($capital) => ucwords($capital)
        );
    }

}

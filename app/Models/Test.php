<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'user_id', 'img'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Arrayable;

class Pronouncitation extends Model implements Arrayable
{
    use HasFactory;

    protected $fillable = [
        'vocabulary_id', 'user_email', 'recognized_word', 'audio_path', 'coincidence'
    ];
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**

 * @property bool $published
 * @property Carbon $published_at

 */

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', 'content',
        'published', 'published_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

//    public static function getRules(): array
//    {
//        return  [
//            'title' => ['required', 'string', 'max:100'],
//            'content' => ['required', 'string'],
//        ];
//    }

    public function isPublished(): bool
    {
        return $this->published
            && $this->published_at;
    }
}

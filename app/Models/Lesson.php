<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\LessonModel
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @mixin \Eloquent
 * @property-read \App\Models\UserLesson $user_lesson
 */
class Lesson extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    //TODO perziureti ar tikrai naudojamas sitas
    public function userLessons(): HasMany
    {
        return $this->hasMany(UserLesson::class, 'lesson_id', 'id');
    }

    public function userLesson(): HasOne
    {
        return $this->hasOne(UserLesson::class, 'lesson_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserLessonModel
 *
 * @property int $id
 * @property string $user_id
 * @property string $lesson_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lesson|null $lessons
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLesson whereUserId($value)
 * @mixin \Eloquent
 * @property-read int|null $lessons_count
 * @property-read \App\Models\User $user
 * @property-read int|null $user_count
 */
class UserLesson extends Model
{
    use HasFactory;
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'lesson_id'
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(Evaluation::class, 'user_lesson_id', 'id');
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'user_lesson_id', 'id');
    }
}

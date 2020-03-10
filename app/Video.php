<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Video
 *
 * @property int $id
 * @property int $page_id
 * @property string $url
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUrl($value)
 * @mixin \Eloquent
 */
class Video extends Model
{
    protected $fillable = ['page_id', 'url', 'position', 'header'];
}

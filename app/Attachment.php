<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attachment
 *
 * @property int $id
 * @property string|null $title
 * @property string $file
 * @property string $entity_type
 * @property int $entity_id
 * @property string|null $web_address
 * @property string|null $file_type
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attachment whereWebAddress($value)
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    protected $fillable = ['file', 'entity_type', 'entity_id', 'web_address', 'title', 'file_type', 'position'];

    /**
     * Get all of the owning  uploads
     * models.
     */
    public function entity()
    {
        return $this->morphTo();
    }
}

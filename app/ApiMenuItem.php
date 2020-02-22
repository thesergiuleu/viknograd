<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiMenuItem extends Model
{
    protected $fillable = ['parent_id', 'page_id'];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

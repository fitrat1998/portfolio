<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutBigImage extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'image', 'title', 'desc'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

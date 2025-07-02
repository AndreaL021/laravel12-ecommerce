<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncementImage extends Model
{
    use HasFactory;
    
    protected $casts = ['labels' => 'array',];
    protected $fillable = ['announcement_id', 'path'];
    public function announcement()
    {

        return $this->belongsTo(Announcement::class);
    }
}

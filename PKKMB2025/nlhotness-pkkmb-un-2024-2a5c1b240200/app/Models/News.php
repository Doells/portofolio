<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;


    public $table = 'news';


    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];


    protected $fillable = [
        'users_id',
        'title',
        'description',
        'date_start',
        'date_finish',
        'date_event',
        'contact_person',
        'price',
        'note',
        'updated_at',
        'created_at',
        'deleted_at',
    ];



    
    // one to one
    

    // one to many
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }

    public function thumbnail_news()
    {
        return $this->hasMany('App\Models\ThumbnailNews', 'news_id');
    }

    public function tagline()
    {
        return $this->hasMany('App\Models\Tagline', 'news_id');
    }
}

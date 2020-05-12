<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    // By default, name of table is 'authors'
    //protected $table = 'oZ1_authors';

    //protected $primaryKey = 'flight_id';

    // Check documentation for more : 
    // https://laravel.com/docs/6.x/eloquent

    public $timestamps = true; // Laravel will add created_at and modified_at information to the object in the backend
    protected $dateFormat = 'Y-m-d H:i:s';

    // TODO: This function does not work
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = ['id','name_ar','name_en','description_ar','description_en'];


    public function categories()
    {
        return $this->belongsToMany(Categories::class,'course_categories');
    }
    public function getImageAttribute($val)
    {
        $domain = parse_url(request()->root())['host'];
        return 'https://'. $domain.'/courses/'.$val;
    }
}

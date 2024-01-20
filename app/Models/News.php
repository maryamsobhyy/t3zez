<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function getImageAttribute($val)
    {
        $domain = parse_url(request()->root())['host'];
        return 'https://'. $domain.'/news/'.$val;
    }
}

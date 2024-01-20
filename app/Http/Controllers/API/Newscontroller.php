<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

class Newscontroller extends Controller
{
    use ApiResponser;
        public function getImgAttribute($val)
        {
            $domain = parse_url(request()->root())['host'];
            return 'https://'. $domain.'/storage/providers/'.$val;
        }
        public function index(Request $request){
            $new_id=$request->new_id;
            $categories=News::
            select('id', 'title_'.app()->getLocale().' as title', 'description_'.app()->getLocale().' as description','image','date')
                                    ->where(function ($query) use ($new_id) {
                                        if($new_id != 0 ){
                                        $query->where('id', '=', $new_id);
                                       }})->get();


    return $this->generateResponse(true, 'Success message', $categories, 200);
}

}

<?php

namespace App\Http\Controllers\API;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

use App\Traits\ApiResponser;

class categorycontroller extends Controller
{

    use ApiResponser;
   
        public function index(Request $request){
                $category_id=$request->category_id;
                $categories=Categories::with('courses:id,name_'.app()->getLocale().' as name ,description_'.app()->getLocale().' as description,price_before_discount,price_after_discount,duration,image')
                ->select('id', 'name_'.app()->getLocale().' as name', 'description_'.app()->getLocale().' as description')
                                        ->where(function ($query) use ($category_id) {
                                            if($category_id != 0 ){
                                            $query->where('id', '=', $category_id);
                                           }})->get();


        return $this->generateResponse(true, 'Success message', $categories, 200);
    }


}




<?php

namespace App;

use App\Picture;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\Model;
use App\PostDetails;
use App\Products;
use App\Stores;
use App\ListDetails;
use App\UserLists;
use Carbon\Carbon;
use Image;
use DB;

class Products extends Model
{
    public function post_details()
    {
        return $this->hasMany('App\PostDetails');
    }

    public function list_details()
    {
        return $this->hasMany('App\ListDetails');
    }

    public function getPicture($id)
    {
        $picture = Products::find($id);
        $avatar = Image::make($picture->avatar);
        $response = Response::make($avatar->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/png');

        return $response;

        $product = Products::find($id);

        $img = Image::make($product->avatar);
        $img->encode('png');
        $type = 'png';
       
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }

}

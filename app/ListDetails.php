<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products;
use App\ListDetails;
use App\UserLists;
use Image;

class ListDetails extends Model
{
    public function products()
    {
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }


    public function getPicture($id)
    {
        $product = Products::find($id);
        $avatar = $product->avatar;

        $img = Image::make($avatar);
        $img->encode('png');
        $type = 'png';

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }
}

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
        $avatar_extension = $product->avatar_extension;

        $img = Image::make($avatar);
        $img->encode($avatar_extension);
        $type = $avatar_extension;

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }
}

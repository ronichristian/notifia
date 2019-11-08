<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostDetails;
use App\Products;
use App\Stores;
use Carbon\Carbon;
use Image;

class PostDetails extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }

    public function stores()
    {
        return $this->belongsTo('App\Stores', 'store_id', 'id');
    }

    public function getPicture($id)
    {
        $product = Products::find($id);

        $img = Image::make($product->avatar);
        $img->encode('jpg');
        $type = 'jpg';

        $base64 = 'data:image/' . $img . ';base64,' . base64_encode($img);

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

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
        $avatar = $product->avatar;

        $img = Image::make($avatar);
        $img->encode('png');
        $type = 'png';

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }

}

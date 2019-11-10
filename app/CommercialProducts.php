<?php

namespace App;
use App\CommercialProducts;
use App\Products;
use Image;

use Illuminate\Database\Eloquent\Model;

class CommercialProducts extends Model
{
    public function get_commercial_product_picture($id)
    {
        $commercial_products = CommercialProducts::find($id);
        $avatar = $commercial_products->avatar;

        $img = Image::make($avatar);
        $img->encode('png');
        $type = 'png';
       
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }
}

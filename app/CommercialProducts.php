<?php

namespace App;
use App\Products;
use Image;

use Illuminate\Database\Eloquent\Model;

class CommercialProducts extends Model
{
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request)
    {

        $photoName = $request->get('photoName');

        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }

        $photo = ProductImage::where('image', $photoName);
        $productId = $photo->first()->product_id;

        $photo->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}

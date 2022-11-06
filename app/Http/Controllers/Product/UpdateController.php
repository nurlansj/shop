<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        };
        if (isset($data['product_images'])) {
            $productImages = $data['product_images'];
            unset($data['product_images']);
            ProductImage::where('product_id', $product->id)->delete();
            foreach ($productImages as $productImage) {
                $currentImagesCount = ProductImage::where('product_id', $product->id)->count();
                if ($currentImagesCount > 3) break;
                $filePath = Storage::disk('public')->put('/images', $productImage);
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath
                ]);
            }
        };
        $tagsIds = $data['tags'];
        $colorsIds = $data['colors'];
        unset($data['tags'], $data['colors']);

        $product->update($data);

        $product->tags()->sync($tagsIds);
        $product->colors()->sync($colorsIds);

        return view('product.show', compact('product'));
    }
}

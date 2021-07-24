<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/19/2021
 * Time: 9:30 PM
 */

namespace App\Repositories\Eloquent;


use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductRepository extends BaseRepository
{
    private $product_image, $category;

    public function __construct(Product $model, ProductImage $image, Category $category)
    {
        parent::__construct($model);

        $this->product_image = $image;
        $this->category = $category;
    }

    public function store($request)
    {

        DB::beginTransaction();

        try {
            request()->request->add(['created_by' => Auth::user()->id]);

            $product = $this->model->create($request->all());

            if ($request->hasFile('image')) {
                $this->createImages($request, $product->id);
            }

            DB::commit();
            return redirect()->back()->with('message', 'Product added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Something went wrong'])->withInput();
        }
    }

    public function getAll()
    {
        return $this->model->with(['images', 'category'])->get();
    }

    public function getProductByCategory($category_id)
    {
        $category_name = $this->category->find($category_id)->category;

        return $this->model->where('qty', '>', 0)->where('category_id', $category_id)->with(['images'])->paginate(4, ['*'], $category_name);
    }

    public function find($id)
    {
        return $this->model->with(['images', 'category'])->findOrFail($id);
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->model->find($id);

            $this->product_image->where('product_id', $product->id)->delete();
            $product->delete();

            DB::commit();
            return redirect(route('admin.products.manage'))->with('message', 'Product Deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('admin.products.manage'))->withErrors(['Something went wrong'])->withInput();
        }
    }

    public function imageDestroy($id)
    {
        $image = $this->product_image->find($id);

        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        } else {
            return redirect()->back()->withErrors(['File does not exists']);
        }

        return $image->forceDelete();
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            request()->request->add(['updated_by' => Auth::user()->id]);

            $product = $this->model->find($id);
            $product->update($request->all());

            if ($request->hasFile('image')) {
                $this->createImages($request, $product->id);
            }

            DB::commit();
            return redirect(route('admin.products.manage'))->with('message', 'Product Updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('admin.products.manage'))->withErrors(['Something went wrong'])->withInput();
        }

    }

    private function createImages($request, $product_id)
    {
        try {
            foreach ($request->file('image') as $img) {
                $image = Image::make($img);
                if ($image->getWidth() > $image->getHeight()) {
                    $image->resize(225, null, function ($constraint) {
                        $constraint->aspectRatio(); //height: auto
                    });
                } else {
                    $image->resize(null, 225, function ($constraint) {
                        $constraint->aspectRatio(); //width: auto
                    });
                }
                $canvas = Image::canvas(225, 225, '#f2f2f2');
                $canvas->insert($image, 'center'); //Add image
                $encoded_image = $canvas->encode('jpg')->getEncoded();
                $image_name = time() . rand(1, 10);
                $img_path = 'public/images/products/' . $product_id . '/' . $image_name . '.jpg';
                Storage::put($img_path, $encoded_image);


                $request->image = 'storage/images/products/' . $product_id . '/' . $image_name . '.jpg';

                $this->product_image->create([
                    'product_id' => $product_id,
                    'image' => $request->image ? $request->image : null
                ]);

            }
        } catch (\Exception $e) {
            return false;
        }
    }
}

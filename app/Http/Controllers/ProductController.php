<?php

namespace App\Http\Controllers;

use App\AddProduct;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests;
use Intervention\Image\Facades\Image as Image;


class ProductController extends Controller
{
    public function addProduct(AddProductRequest $request)
    {

        $addProducts = new AddProduct();
        $addProducts->title = $request->title;
        $addProducts->slug = $request->slug;
        $addProducts->detail = $request->detail;
        $addProducts->status = $request->status;
        $addProducts->stock = $request->stock;
        $addProducts->price = $request->price;


        if ($request->hasFile('featured_images')) {

            $image = $request->file('featured_images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 500)->save($location);
            file_put_contents($filename,base64_decode($image));
            $addProducts->featured_images = $filename;
        }

        $images = $request->file('other_image');
        if (!empty($images)) {
            foreach ($images as $otherImage) {
                $filename = time() . '.' . $otherImage->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(800, 500)->save($location);
                $otherImages[] = $filename;
                $addProducts->other_image = implode(',', $otherImages);

            }
        }

        if ($addProducts->save()) {

            $response = [
                'data' => ['message' => 'success'],
                'status' => 200
            ];

        } else {
            $response = [
                'data' => ['message' => 'Unsuccess'],
                'status' => 201
            ];
        }

        return $response;


    }

    public function updateProduct(AddProductRequest $request, $id)
    {


        $updateProducts = AddProduct::find($id);
        $updateProducts->title = $request->title;;
        $updateProducts->slug = $request->slug;
        $updateProducts->detail = $request->detail;
        $updateProducts->status = $request->status;
        $updateProducts->stock = $request->stock;
        $updateProducts->price = $request->price;
        //$updateProducts->save();

        //dd($request->all());

        if ($request->hasFile('featured_images')) {

            $image = $request->file('featured_images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 500)->save($location);
        //    file_put_contents($filename,base64_decode($image));
            $updateProducts->featured_images = $filename;
        }

        $images = $request->file('other_image');
        if (!empty($images)) {
            foreach ($images as $otherImage) {
                $filename = time() . '.' . $otherImage->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(800, 500)->save($location);
                $otherImages[] = $filename;
                $updateProducts->other_image = implode(',', $otherImages);

            }
        }


        if ($updateProducts->save()) {

            $response = [
                'data' => ['message' => 'Product update success'],
                'status' => 200
            ];

        } else {
            $response = [
                'data' => ['message' => 'Product update unsuccess'],
                'status' => 201
            ];
        }

        return $response;
    }

    public function getProductList()
    {

        $getProduct = AddProduct::paginate(50);
        return response()->json($getProduct);
    }

    public function deleteProduct($id)
    {

        $deleteProducts = AddProduct::find($id);
        //$deleteProducts->delete();
        if ($deleteProducts->delete()) {

            $response = [
                'data' => ['message' => 'Product deleted successfully '],
                'status' => 200
            ];

        } else {
            $response = [
                'data' => ['message' => 'Product not deleted'],
                'status' => 201
            ];
        }

        return $response;
    }

    public function detailProduct($id){

        $detailProducts = AddProduct::find($id);
        //return response()->json(['product' =>$detailProducts]);
        //'data' => ['message' => 'Product deleted successfully ']
//        $result = array();
//        //$row = mysqli_fetch_array($r);
//        array_push($result,array(
//            "Product_id"=>$detailProducts['id'],
//            "Product_title"=>$detailProducts['title'],
//            "desg"=>'designation',
//            "salary"=>'salary'
//        ));

        //displaying in json format
        //echo json_encode(array('data'=>$result));

        return  ['data' => [$detailProducts]];


    }
}

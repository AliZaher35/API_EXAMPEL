<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    //
public function index(){

$product=Product::all();
return response()->json([
'success'=>true,
'message'=>'Data List',
'data'=>$product,
]);
}    
public function store(Request $request){
    $input=$request->all();
    $validate=Validator::make($input,[
        'name'=>'required',
        'detail'=>'required',
    ]);
    if($validate->fails()){

     return response()->json([

        'fail'=>false,
        'message'=>'sorry not stored',
        'error'=>$validate->errors(),
    ]);
    }
   $product=Product::create($input);
   return response()->json([
    'success'=>true,
    'message'=>'Product created successfully',
    'data'=>$product,
    ]);
}
public function show(string $id){

$product=Product::find($id);
if(is_null($product)){

    return response()->json([

       'fail'=>false,
       'message'=>'sorry Product not found',
   ]);}
   return response()->json([

    'success'=>true,
    'message'=>'This Product Info',
    'data'=>$product,

   ]);
   


}
public function update($id,Request $request){

$input =$request->all();
$product=Product::find($id);
$validate=Validator::make($input,[
    'name'=>'required',
    'detail'=>'required',
]);
if($validate->fails()){

    return response()->json([

       'fail'=>false,
       'message'=>'sorry not Updated',
       'error'=>$validate->errors(),
   ]);
   }

$product->name=$input['name'];
$product->detail=$input['detail'];
$product->save();

return response()->json([

    'success'=>true,
    'message'=>'Product updated successfully',
    'data'=>$product,
   ]);
    
}
public function destroy($id) {
    $product=Product::find($id);
    $product->delete();
    return response()->json([

        'success'=>true,
        'message'=>'Product deleted successfully',
        'data'=>$product,
       ]);

}
}
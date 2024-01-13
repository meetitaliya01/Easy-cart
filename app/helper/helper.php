<?php


use App\Models\brand;
use App\Models\Category;
use App\Models\product;

function message($class,$msg)
{
    $cls='add'.$class;
    notyf()
    ->position('x', 'center')
    ->position('y', 'bottom') 
    ->$cls($msg);
}
function getCategory()
{
    return Category::with('sub_category')->where('status', 1)->orderBy('name','ASC')->get();
}

function brand()
{
    return brand::where('status',1)->orderBy('name','ASC')->get();
}

function product()
{
    return product::with('images')->where('status',1)->orderBy('title','ASC')->paginate(8);
}

?>
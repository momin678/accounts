<?php

namespace App\Models\Benefit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class CategoryBenefit extends Model
{
    use HasFactory;
    public static function get_immediate_children($id, $with_trashed = false, $as_array = false){
        $children = $with_trashed ? Category::where('parent_id', $id)->orderBy('order_level', 'desc')->get() : Category::where('parent_id', $id)->orderBy('order_level', 'desc')->get();
        $children = $as_array && !is_null($children) ? $children->toArray() : array();
        return $children;
    }
    public static function get_immediate_children_ids($id, $with_trashed = false){
        $children = CategoryBenefit::get_immediate_children($id, $with_trashed = false);
        return !empty($children) ? array_column($children, 'id') : array();
    }
    public static function move_children_to_parent($id){
        $children_ids = CategoryBenefit::get_immediate_children_ids($id);
        $category = Category::where('id', $id)->first();
        CategoryBenefit::move_level_up($id);
        Category::whereIn('id', $children_ids)->update(['parent_id' => $category->parent_id]);
    }
    public static function move_level_up($id){
        if(CategoryBenefit::get_immediate_children_ids($id, true) > 0){
            foreach(CategoryBenefit::get_immediate_children_ids($id, true) as $value){
                $category = Category::find($value);
                $category->level -= 1;
                $category->save();
                return CategoryBenefit::move_level_up($value);
            }
        }
    }
    public static function delete_category($id){
        $category = Category::where('id', $id)->first();
        if(!is_null($category)){
            CategoryBenefit::move_children_to_parent($category->id);
            $category->delete();
        }
    }
}

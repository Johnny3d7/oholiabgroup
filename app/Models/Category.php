<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid uuid
 * @property varchar $reference reference
 * @property varchar $name name
 * @property varchar $icone icone
 * @property int $id_categories id categories
 * @property IdCategory $category belongsTo
 * @property \Illuminate\Database\Eloquent\Collection $category belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $product belongsToMany
 * 
 */
class Category extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'categories';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'reference', 'name', 'icone', 'id_categories'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    public static function mothers(){
        return static::whereNull('id_categories')->get();
    }

    /**
    * category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class,'id_categories');
    }

    /**
    * categories
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function categories()
    {
        return $this->hasMany(Category::class,'id_categories');
    }
    public function children()
    {
        return $this->whereIdCategories($this->id)->get();
    }
    /**
    * products
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function products()
    {
        return $this->belongsToMany(Product::class,'products');
    }



}
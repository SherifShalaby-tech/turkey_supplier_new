<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    // protected $dates = ['deleted_at'];

    protected $guarded = [];

    protected $appends = ["is_like","isFavourite"];

    protected $casts = [
        // 'category_id' => 'integer',
        // 'company_id' => 'integer',
        // 'sub_category_id' => 'integer',
        // 'unit_id' => 'integer',
        // 'unit_sale_id' => 'integer',
        // 'unit_purchase_id' => 'integer',
        // 'is_variant' => 'integer',
        // 'brand_id' => 'integer',
        // 'is_active' => 'integer',
        // 'cost' => 'double',
        // 'price' => 'double',
        // 'stock_alert' => 'double',
        // 'TaxNet' => 'double',
        'translation' => 'array',
    ];
    public function getisFavouriteAttribute()
    {
        if(auth('company')->user()){
            // $user=Company::find(auth('company')->user()->id);
            // $data=$user->products()->get();
            $data=Favorite::where('company_id',auth('company')->user()->id)
            ->where('product_id',$this->id)
            ->first();
            if ($data!==null) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }
    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }
//    public function images(){
//        return $this->hasMany('App\Models\ProductImage','product_id');
//    }
    public function ProductVariant()
    {
        return $this->belongsTo('App\Models\ProductVariant');
    }

    public function PurchaseDetail()
    {
        return $this->belongsTo('App\Models\PurchaseDetail');
    }

    public function SaleDetail()
    {
        return $this->belongsTo('App\Models\SaleDetail');
    }

    public function QuotationDetail()
    {
        return $this->belongsTo('App\Models\QuotationDetail');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategories::class,'sub_category_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function unitPurchase()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_purchase_id');
    }

    public function unitSale()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_sale_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }



    public function rating(){
        return $this->hasMany('App\Models\Rating','product_id');
    }

    public function colors(){
        return $this->hasMany(Color::class,'product_id');
        // return $this->hasMany('App\Models\Color','product_id');
    }
    public function sizes(){
        return $this->hasMany('App\Models\Size','product_id');
    }
    public function leadtimes(){
        return $this->hasMany('App\Models\Leadtime','product_id');
    }
    public function certificates(){
        return $this->hasMany(Certificate::class,'product_id');
    }
    public function product_tags(){
        return $this->hasOne('App\Models\ProductTag','product_id');
    }
    public function getNameAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['name'][app()->getLocale()]))
            {
                return $this->translation['name'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['description'][app()->getLocale()]))
            {
                return $this->translation['description'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
    public function company(): BelongsTo{
        return $this->belongsTo(Company::class,'company_id');
    }

       //scope
       public function scopeWhenCatId($query, $catId)
       {
           return $query->when($catId, function ($q) use ($catId) {
               return $q->whereHas('category', function ($qu) use ($catId) {
                   return $qu->where('id', $catId);
               });
           });
       }// end of scopeWhenCatId
         //scope
         public function scopeWhenSubcatId($query, $subcatId)
         {
             return $query->when($subcatId, function ($q) use ($subcatId) {
                 return $q->whereHas('subcategory', function ($qu) use ($subcatId) {
                     return $qu->where('id', $subcatId);
                 });
             });
         }// end of scopeWhensubcatId

       //scope
       public function scopeWhenComId($query, $comId)
       {
           return $query->when($comId, function ($q) use ($comId) {
                   return $q->where('company_id', $comId);

            //    return $q->whereHas('campany', function ($qu) use ($comId) {
            //        return $qu->where('id', $comId);
            //    });
           });
       }// end of scopeWhenComId

       public function getIsLikeAttribute()
       {
          if(Auth::guard('company')->user()){
            $fav = DB::table("favorites")->where('company_id',Auth::guard('company')->id())
                                  ->where('product_id',$this->id)->first();
            if($fav){
                return true;
            }
          }
          return false;
       }
   
   
}

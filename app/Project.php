<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = ['name', 'slug'];
    /**
     * Set the unique project slug
     *
     * @param  string  $value
     * @return string
     */
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $slugCount = count( $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
        $slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
        $this->attributes['slug'] = $slugFinal;
    }
    /**
     * Generate a unique public_id
     *
     * @param  string  $value
     * @return string
     */
    public function setPublicIdAttribute($value)
    {
        do{
    	   $newPublicId = chr(rand(64, 90)) . chr(rand(64, 90)) . rand(10,99);
            $publicIdCount = count( $this->whereRaw("public_id = '{$newPublicId}'")->get());
        }while($publicIdCount != 0);
        $this->attributes['public_id'] =  $newPublicId;
    }

    /**
     * Replace id by slug in urls
     */
    public function getRouteKey()
    {
    	$this->slug;
    }
    
    /**
     * Query project by public Id
     */
    public function scopePublicId($query, $id)
    {
        return $query->where('public_id',$id);
    }

    /**
     * Query project by sug
     */
    public function scopeSlug($query, $id)
    {
        return $query->where('slug', $id)->first();
    }

    /**
     * A project may own many accesses
     */
    public function accesses()
    {
        return $this->hasMany('App\Access');
    }

    /**
     * Handle children deletion on project removal
     */
    public static function boot()
    {
        parent::boot();    
        static::deleted(function($product)
        {
            $product->accesses()->delete();
        });
    }
}

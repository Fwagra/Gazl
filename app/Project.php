<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{    
    protected $fillable = ['name', 'slug'];

    /**
     * Set the unique project name and generate a slug automatically (each time 
     * the name is set).
     *
     * There's 3 scenarios for settings a slug:
     *   1. It doesn't exist
     *   2. It exists and hasn't changed
     *   3. It exists and has changed
     *
     * @param  string  $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        // Set name (yes, that's the original point of this method).
        $this->attributes['name'] = $value;

        // Generate slug from the project name.
        $slug = Str::slug($value);
        
        // If the entity is already saved, let's check if there really is the
        // need to generate a slug.
        if ($this->id) {
            // Generate slugs from old name.
            $oldSlug = Str::slug($this->name);

            // Do nothing if there's no change.
            if ($slug == $oldSlug)
                return;
        }

        // Search for identical slugs.
        $slugs_found = $this->whereRaw(
            "slug REGEXP '^{$slug}(-[0-9]*)?$' AND id != ?", 
            // Set Project ID to 0 if not defined to prevent SQL error.
            array($this->id ? $this->id : '0')
        )->get();
 
        // If a slug is found and isn't associated with the current entity, 
        // add a suffix to prevent conflicts.
        if ($slugs_found->count()) {
            for ($i = $slugs_found->count(); true; $i++) {
                $_slug = $slug . '-' . $i;
                
                if ($this->slugIsAvailable($_slug)) {
                    $slug = $_slug;
                    break;
                }
                else
                    continue;
            }
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Generate a unique public_id
     *
     * @param  string  $value
     * @return string
     */
    public function slugIsAvailable($slug)
    {
        return !$this->whereRaw("slug = ?", array($slug))->get()->count();
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
     * A project may own many checklist answers
     */
    public function checklistAnswers()
    {
        return $this->hasMany('App\ChecklistAnswer');
    }

    /**
     * Get the project cms name.
     */
    public function cms()
    {
        return $this->belongsTo('App\Cms');
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
            $product->checklistAnswers()->delete();
        });
    }
}

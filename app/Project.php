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
     * Replace id by slug in urls
     */
    public function getRouteKeyName()
    {
      return 'slug';
    }

    /**
     * Query project by public Id
     */
    public function scopePublicId($query, $id)
    {
        return $query->where('public_id',$id);
    }

    /**
     * Query project by slug
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
     * A project may own many reported bugs
     */
    public function bugs()
    {
        return $this->hasMany('App\Bug');
    }

    /**
     * A project may be linked to many contacts
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contact')->withPivot('is_starred');
    }
    /**
     * Some contacts may be "starrified" (to be displayed on project's homepage)
     */
    public function starrified_contacts()
    {
		return $this->belongsToMany('App\Contact')->wherePivot('is_starred', 1);
    }

    /**
     * A project may own many notifcation subscriptions
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * A project may own many memos
     */
    public function memos()
    {
        return $this->hasMany('App\Memo');
    }

    /**
     * A project may own many mockups
     */
    public function mockups()
    {
        return $this->hasMany('App\Mockup');
    }

    /**
     * A project may own many mockup categories
     */
    public function mockupCategories()
    {
        return $this->hasMany('App\MockupCategory');
    }

    /**
     * A project may have one documentation (client-oriented)
     */
    public function documentation()
    {
        return $this->hasOne('App\Documentation');
    }

    /**
     * A project may have one wiki (internal documentation)
     */
    public function internalDocumentation()
    {
        return $this->hasOne('App\InternalDocumentation');
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
        static::deleting(function($project)
        {
            $project->accesses()->delete();
            $project->checklistAnswers()->delete();
            $project->bugs()->delete();
            $project->memos()->delete();
            $project->documentation()->delete();
            $project->internaldocumentation()->delete();
            $project->notifications()->delete();
            $project->mockupCategories()->delete();

            // In order to trigger static::delete in Mockup Model
            foreach ($project->mockups as $mockup) {
                $mockup->delete();
            }
        });
    }
}

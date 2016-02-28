<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'images',
        'project_id',
        'author',
        'email',
        'guest',
        'private',
        'state',
    ];
    /**
     * Automatic (un)serialization for bug's images
     */
    protected $casts = [
        'images' => 'array',
    ];

    protected $guestID;

    /**
     * A bug may own many reported comments
     */
    public function comments()
    {
        return $this->hasMany('App\BugComment');
    }

    /**
     * Checking if the provided URL has the http prefix
     */
    protected function getUrlAttribute($value)
    {
        if(strpos($value, 'http') === false || strpos($value, 'http') != 0)
            return 'http://'.$value;
    }

    /**
     * Replaces the author value by the user's name if it's not "guest" bug
     */
    protected function getAuthorAttribute($value)
    {
        if($this->guest == 0){
            if($user = User::find($value)){
                // We keep the original value if needed
                $this->guestID = $value;
                $value =  $user->first_name . ' ' . $user->name;
            }else{
                $value = trans('global.undefined_username');
            }
        }
        return $value;
    }

    /**
     * Replaces the email value by the user's mail if it's not a "guest" bug
     */
    protected function getEmailAttribute($value)
    {
        if($this->guest == 0){
            if($user = User::find($this->guestID)){
                $value =  $user->email;
            }else{
                $value = trans('global.undefined_mail');
            }
        }
        return $value;
    }
}

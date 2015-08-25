<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cookie;
use Crypt;
use Lang;
use Config;
use Illuminate\Contracts\Encryption\DecryptException;

class Access extends Model
{
	protected $fillable = ['name', 'login', 'password', 'host', 'project_id'];

	/**
	 * An access belongs to a project
	 */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Encrypt a password with the global key stored in a cookie
     * @param string $value
     * @return response
     */
    public function setPasswordAttribute($value)
    {
    	$key = Cookie::get('key');
    	Crypt::setKey($key);
    	$encryptedPass = Crypt::encrypt($value);
    	// WARNING //
    	// The user is logged out if we don't reapply the app key like this : 
    	Crypt::setKey(Config::get('app.key'));
    	/////////////
    	$this->attributes['password'] = $encryptedPass;
    }

    /**
     * Return a decrypted password
     * @param string $value
     * @return string
     */
    public function getPasswordAttribute($value)
    {
    	if(Cookie::get('key') == null){
    		return trans('access.no_key_get_pass');
    	}
    	
    	$key = Cookie::get('key');
    	Crypt::setKey($key);

    	try {
    		$result = Crypt::decrypt($value);
    	} catch (DecryptException $e) {
    		$result = trans('access.wrong_key_get_pass');
    	}
    	Crypt::setKey(Config::get('app.key'));
    	
    	return $result;
    }
}

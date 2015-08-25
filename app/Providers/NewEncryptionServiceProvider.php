<?php

namespace App\Providers;

use App\NewEncrypter;
use RuntimeException;
use Illuminate\Support\ServiceProvider;

class NewEncryptionServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('encrypter', function ($app) {
            $config = $app->make('config')->get('app');

            $key = $config['key'];

            $cipher = $config['cipher'];

            if (NewEncrypter::supported($key, $cipher)) {
                return new NewEncrypter($key, $cipher);
            } elseif (McryptEncrypter::supported($key, $cipher)) {
                return new McryptEncrypter($key, $cipher);
            } else {
                throw new RuntimeException('No supported encrypter found. The cipher and / or key length are invalid.');
            }
        });
    }
}

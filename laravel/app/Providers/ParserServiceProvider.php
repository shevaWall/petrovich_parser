<?php
namespace  App\Providers;

use Illuminate\Support\ServiceProvider;

class ParserServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind('Parser', 'App\Service\ParserService');
    }
}

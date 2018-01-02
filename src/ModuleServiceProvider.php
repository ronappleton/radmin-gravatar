<?php

namespace RonAppleton\Radmin\Gravatar;

use Illuminate\Support\ServiceProvider;
use Auth;
use Blade;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('gravatar', function ($size = null) {
            if(Auth::check())
            {
                if(empty($size))
                {
                    $size = 25;
                }

                $email = Auth::user()->email;

                $gravatarUrl = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;

                $style = 'border-radius: 50%;-moz-border-radius: 50%;-webkit-border-radius: 50%;';

                return "<li class='nav-item' style='{$style}'><a class='nav-link' href='https://gravatar.com'><img src='{$gravatarUrl}' height='{$size}px' width='{$size}px'></a></li>";
            }
            return '';
        });
    }
}
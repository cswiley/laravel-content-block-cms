<?php

if (!function_exists('cms_assets')) {
    function cms_assets($path, $secure = null)
    {
        $base = '/vendor/cswiley/cms/assets';
        return asset($base . '/' . $path, $secure);
    }
}

<?php

if (!function_exists('cms_assets')) {
    function cms_assets($path, $secure = null)
    {
        $base = config('cms.assets_path');
        return asset($base . '/' . $path, $secure);
    }
}

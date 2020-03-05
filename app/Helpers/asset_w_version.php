<?php

if (! function_exists('asset_w_version')) {
    /**
     * Generate an asset path for the application.
     *
     * @param $type
     * @param string $path
     * @param bool $secure
     *
     * @return string
     */
    function asset_w_version($type, $path,  $secure = null)
    {
        $versioning = config('agentquote-versioning');
        switch($type) {
            case 'app':
                $ver = $versioning['app'];
                break;
            case 'js':
                $ver = $versioning['js'];
                break;
            case 'css':
                $ver = $versioning['css'];
                break;
            default:
                $ver = $versioning['global'];
        }
        $path = asset($path) . '?v=' . $ver;
        return $path;
    }
}

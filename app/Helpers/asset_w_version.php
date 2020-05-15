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

if (! function_exists('asset_w_version2')) {
    /**
     * Generate an asset path for the application.
     *
     * @param $type
     * @param string $path
     * @return string
     */
    function asset_w_version2($type, $path)
    {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();

        $path = asset($path) . '?v=' . $timestamp;
        return $path;
    }
}

<?php

if (! function_exists('asset_prepend')) {
    /**
     * Generate an asset path for the application.
     *
     * @param $before
     * @param string $path
     *
     * @param bool $secure
     *
     * @return string
     */
    function asset_prepend($before, $path, $secure=false)
    {
        $secure = $secure ?: config('agentquote.company.domain.scheme') === 'https';

        return app('url')->asset($before . $path, $secure);
    }
}

<?php

declare(strict_types=1);

namespace PackageVersions;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = 'laravel/laravel';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    public const VERSIONS          = array (
  'beberlei/assert' => 'v2.x-dev@124317de301b7c91d5fce34c98bba2c6925bec95',
  'dnoegel/php-xdg-base-dir' => '0.1@265b8593498b997dc2d31e75b89f053b5cc9621a',
  'doctrine/inflector' => '1.3.x-dev@45d9b132b262c1d03835cdeefd42938d881556fa',
  'doctrine/lexer' => 'dev-master@ec953a1b157db060fc9576a6f6b6b1865a09aac9',
  'dragonmantank/cron-expression' => 'dev-master@c9d0f452bcc19c3f788132f14de2920b958b00f1',
  'dzineer/custom-modules' => 'dev-master@971783db47b770fd13a2634c66adb05bae245521',
  'dzineer/dz-sms' => 'dev-master@eee578a3eaa518dcde34d1128b46774e2e2cb0a1',
  'dzineer/landing-pages' => 'dev-master@d6e492250bcc7bd93f2c4de2058994f866580c6b',
  'dzineer/laravel-adminlte' => 'dev-master@9a87493bd1a23d3278934a87a4dc604017f3c4f6',
  'dzineer/reseller-club-v2' => 'dev-master@bde3fb20b92b304879a798d98d529b09483e8149',
  'egulias/email-validator' => 'dev-master@950d0663dc81e4ef3da2d406a8f3978bc9938bb2',
  'erusev/parsedown' => '1.8.0-beta-7@fe7a50eceb4a3c867cc9fa9c0aa906b1067d1955',
  'fgrosse/phpasn1' => '2.1.x-dev@734e1a94dfb292199f4f285be99a5645ea66fb58',
  'fideloper/proxy' => '4.2.1@03085e58ec7bee24773fa5a8850751a6e61a7e8a',
  'guzzlehttp/guzzle' => 'dev-master@a7010cc9b52ecfa00051bb26e4ae025958fe9851',
  'guzzlehttp/promises' => 'dev-master@17d36ed176c998839582c739ce0753381598edf0',
  'guzzlehttp/psr7' => '1.x-dev@2595b33c1c924889b474d324f3d719fa40b6954e',
  'iamcal/sql-parser' => 'v0.2@dcb614bae8151ed9db79f56cb2cf369b9749f21b',
  'intervention/image' => '2.5.0@39eaef720d082ecc54c64bf54541c55f10db546d',
  'jakub-onderka/php-console-color' => 'v0.2@d5deaecff52a0d61ccb613bb3804088da0307191',
  'jakub-onderka/php-console-highlighter' => 'v0.4@9f7a229a69d52506914b4bc61bfdb199d90c5547',
  'laravel-notification-channels/webpush' => '3.0.1@cb285b704ec877f2de74a1da0c381962e6c2e45b',
  'laravel/framework' => '5.8.x-dev@2bd0ef74d6962daea31045cb6f15aecb1fe2d19e',
  'laravel/tinker' => 'dev-master@80f6787d4db0b3eaf62ff17a825c837bc5bc61e1',
  'lcobucci/jwt' => '3.3.x-dev@a11ec5f4b4d75d1fcd04e133dede4c317aac9e18',
  'league/flysystem' => 'dev-master@301014816b2fb5d0776867e205ae7a3cbd1c3c8a',
  'mdanter/ecc' => 'v0.5.2@b95f25cc1bacc83a9f0ccd375900b7cfd343029e',
  'minishlink/web-push' => 'v2.0.1@6e1b88c46351ea3850cb1e9ae9565b8c61a58396',
  'moneyphp/money' => 'dev-master@1961f445ef0273a651ece4b9177d8885d37deda4',
  'monolog/monolog' => '1.x-dev@bd95e23bd212a96d75f4e6b2a105063a91fa1971',
  'nesbot/carbon' => 'dev-master@32f184cf27d00e41f99021b2a1fbcc5abe713976',
  'nexmo/client' => 'dev-master@0d45cced049735f0762caccfdae02024b93a5062',
  'nexmo/client-core' => '2.0.0@f73f7c50ec14b94dc7fda60cc13298f5901fc785',
  'nikic/php-parser' => 'dev-master@603203177e8483205f1f8b8cf31a41ec20a6c880',
  'ocramius/package-versions' => 'dev-master@1d32342b8c1eb27353c8887c366147b4c2da673c',
  'opis/closure' => '3.4.0@60a97fff133b1669a5b1776aa8ab06db3f3962b7',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'php-http/guzzle6-adapter' => 'dev-master@4b491b78e1b24ca941e6ca925f48a63e6a2d9a45',
  'php-http/httplug' => 'dev-master@7af4427dc789a03245635113c39b53e7d6faf6c7',
  'php-http/promise' => 'dev-master@1cc44dc01402d407fc6da922591deebe4659826f',
  'phpoption/phpoption' => '1.5.0@94e644f7d2051a5f0fcf77d81605f152eecff0ed',
  'plivo/plivo-php' => 'v1.1.7@5d3417f654d8b59b64707661f2c202f32a554783',
  'predis/predis' => 'v1.1.x-dev@111d100ee389d624036b46b35ed0c9ac59c71313',
  'psr/cache' => 'dev-master@b9aa2cd4dd36cec02779bee07ee9dab8bd2d07d7',
  'psr/container' => 'dev-master@fc1bc363ecf887921e3897c7b1dad3587ae154eb',
  'psr/http-client' => 'dev-master@fd5d37ae5a76ee3c5301a762faf66bf9519132ef',
  'psr/http-factory' => 'dev-master@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => 'dev-master@efd67d1dc14a7ef4fc4e518e7dee91c271d524e4',
  'psr/log' => 'dev-master@e1cb6eca27ccfd46567a2837eeba62bc5fecdee2',
  'psr/simple-cache' => 'dev-master@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'dev-develop@fca347d4a80400997bb3075de4f5380cde5fbd21',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.x-dev@4c467ce4d5a72c3cf0832c813d4d84d222c3d4bb',
  'spomky-labs/aes-key-wrap' => 'v4.0.1@6d302dc2d20cd61fc8bf0e253d628c70724d302a',
  'spomky-labs/base64url' => 'v1.x-dev@a6d123a94f7b9b9dacebd1d8db205d81289fa2ea',
  'spomky-labs/jose' => 'dev-master@258147540e8304ba178db12a94ecef49525da768',
  'spomky-labs/php-aes-gcm' => 'v1.x-dev@c0dc337c543b779042ab1c0537e4061b785ba695',
  'swiftmailer/swiftmailer' => 'dev-master@a53dab202d27506cad9f0238e8ef2c53dee91c88',
  'symfony/console' => '4.4.x-dev@20bc0c1068565103075359f5ce9e0639b36f92d1',
  'symfony/css-selector' => 'dev-master@4b85443ab5e269ed8c7554745890726c57bfeb04',
  'symfony/debug' => '4.4.x-dev@36e10ee67885281e867d1b9d70467194024db5d3',
  'symfony/error-handler' => 'dev-master@eceaaff108ec75d7a7b8c3c2fbd5b2b0a500a65e',
  'symfony/error-renderer' => 'dev-master@c7ed1680f63d8ab6af3b3d9cecb9c93024a0ee11',
  'symfony/event-dispatcher' => '4.4.x-dev@4bc5679ace049e7c28ef582c4e62ab6febbbfd4c',
  'symfony/event-dispatcher-contracts' => 'dev-master@c43ab685673fb6c8d84220c77897b1d6cdbe1d18',
  'symfony/finder' => '4.4.x-dev@5729f943f9854c5781984ed4907bbb817735776b',
  'symfony/http-foundation' => '4.4.x-dev@0eebd4379eb075910e0c91864188ad5dd0035e01',
  'symfony/http-kernel' => '4.4.x-dev@1608e1d2c93477a4e9bdac46a3d0fd3199be582e',
  'symfony/mime' => 'dev-master@fcf948d25747ff2daf3dffd4d758b5183ea88111',
  'symfony/polyfill-ctype' => 'dev-master@4719fa9c18b0464d399f1a63bf624b42b6fa8d14',
  'symfony/polyfill-iconv' => 'dev-master@685968b11e61a347c18bf25db32effa478be610f',
  'symfony/polyfill-intl-idn' => 'dev-master@6af626ae6fa37d396dc90a399c0ff08e5cfc45b2',
  'symfony/polyfill-mbstring' => 'dev-master@7220dc953b5082a9192d11b2235f1b5824e8aa5d',
  'symfony/polyfill-php72' => 'dev-master@04ce3335667451138df4307d6a9b61565560199e',
  'symfony/polyfill-php73' => 'dev-master@0f27e9f464ea3da33cbe7ca3bdf4eb66def9d0f7',
  'symfony/process' => '4.4.x-dev@6c53bfbdf5c456b3db64adea13db773ec702c9df',
  'symfony/routing' => '4.4.x-dev@9e472b4799cd964ea05b3dce69f831afbc1fef07',
  'symfony/service-contracts' => 'dev-master@1d69dad232b9d88e495766b7b6cb857627d6bedc',
  'symfony/translation' => '4.4.x-dev@46df2290b5dc8a53b4ded00f7e4b49e4ccd2a388',
  'symfony/translation-contracts' => 'dev-master@fa3238c55d9d4d8f78b4bc5f17374b017e07dea7',
  'symfony/var-dumper' => '4.4.x-dev@c85ac5426a9cab42e750eaa357386734f05320e2',
  'tijsverkoyen/css-to-inline-styles' => 'dev-master@33e9039a78e180fed4b7b9956477280c015e32f3',
  'twbs/bootstrap' => 'v4.1.3@3b558734382ce58b51e5fc676453bfd53bba9201',
  'twilio/sdk' => '4.12.1@0a88c48262fbee1c3841f721f46439d3de450b95',
  'unisharp/laravel-filemanager' => 'v1.x-dev@b8e39a1fd5d15ba537046890f312b98e2ec3da02',
  'vlucas/phpdotenv' => 'dev-master@1bdf24f065975594f6a117f0f1f6cabf1333b156',
  'zendframework/zend-diactoros' => 'dev-develop@4930fd0646f98cd6be9c0e1963faf4ab5db17a58',
  'afosto/yaac' => 'dev-master@fb33b4ba6f3f514d90c162aa4e157fad91a904ba',
  'ajthinking/tinx' => 'v2.6.0@1521cf0a8035d8192ac317f39e1a09b3222b9cf0',
  'barryvdh/laravel-debugbar' => 'dev-master@4fb3665d24bdcdb403035e81ec1c36cca505f778',
  'doctrine/cache' => '1.10.x-dev@766a5a5c8694166f522c534a6663786b847378e7',
  'doctrine/dbal' => '2.11.x-dev@3b0e9429390d15dac657f0e22b8a59962163a581',
  'doctrine/event-manager' => '1.1.x-dev@c0d087c34cd5c2f86e7b840de9cecfb1e048dd52',
  'doctrine/instantiator' => 'dev-master@7c71fc2932158d00f24f10635bf3b3b8b6ee5b68',
  'filp/whoops' => '2.5.0@cde50e6720a39fdacb240159d3eea6865d51fd96',
  'fzaninotto/faker' => 'dev-master@73192096ed649e2b3d7043a227aa94bd4d8be561',
  'hamcrest/hamcrest-php' => 'dev-master@c0436bf63689fc334f67ccaa5e17458af9700b42',
  'maximebf/debugbar' => 'dev-master@2a95c20da4c6965114e5773f3aaf974e12f9c92b',
  'mockery/mockery' => 'dev-master@efa86ea7983826b6485ad62c6dd030c9887121d7',
  'myclabs/deep-copy' => '1.x-dev@9012edbd1604a93cee7e7422d07a2c5776c56e0c',
  'nunomaduro/collision' => 'v2.1.1@b5feb0c0d92978ec7169232ce5d70d6da6b29f63',
  'phar-io/manifest' => 'dev-master@8c8bd1bb1a22f311b1b4886662b989d0d02aab77',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.0.0@63a995caa1ca9e5590304cd845c15ad6d482a62a',
  'phpdocumentor/reflection-docblock' => 'dev-master@8fcadfe5f85c38705151c9ab23b4781f23e6a70e',
  'phpdocumentor/type-resolver' => '0.7.x-dev@6f6f66c1d4e14e9b0ad124cae85864dfa03104c7',
  'phpspec/prophecy' => '1.9.0@f6811d96d97bdf400077a0cc100ae56aa32b9203',
  'phpunit/php-code-coverage' => '6.1.4@807e6013b00af69b6c5d9ceb4282d0393dbb9d8d',
  'phpunit/php-file-iterator' => 'dev-master@7f0f29702170e2786b2df813af970135765de6fc',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => 'dev-master@37d2894f3650acccb6e57207e63eb9699c1a82a6',
  'phpunit/php-token-stream' => 'dev-master@36bdcb91de0484f77e256fd3d6119dcf7171c164',
  'phpunit/phpunit' => '7.5.x-dev@316afa6888d2562e04aeb67ea7f2017a0eb41661',
  'reliese/laravel' => 'v0.0.13@10075c5f5e67efba18d781216ff5a0ffa3fc2d7f',
  'sebastian/code-unit-reverse-lookup' => 'dev-master@5e860800beea5ea4c8590df866338c09c20d3a48',
  'sebastian/comparator' => 'dev-master@9a1267ac19ecd74163989bcb3e01c5c9587f9e3b',
  'sebastian/diff' => 'dev-master@d7e7810940c78f3343420f76adf92dc437b7a557',
  'sebastian/environment' => 'dev-master@520187a48d1fd3714dd4ebfd8eb914a4d69d26a7',
  'sebastian/exporter' => 'dev-master@68609e1261d215ea5b21b7987539cbfbe156ec3e',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => 'dev-master@63e5a3e0881ebf28c9fbb2a2e12b77d373850c12',
  'sebastian/object-reflector' => 'dev-master@3053ae3e6286fdf98769f18ec10894dbc6260a34',
  'sebastian/recursion-context' => 'dev-master@a58220ae18565f6004bbe15321efc4470bfe02fd',
  'sebastian/resource-operations' => 'dev-master@d67fc89d3107c396d161411b620619f3e7a7c270',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'simplesoftwareio/simple-sms' => 'dev-master@93e7feb7a1f76634b49247bb5849f06a879a3fb4',
  'theseer/tokenizer' => '1.1.3@11336f6f84e16a720dae9d8e6ed5019efa85a0f9',
  'webmozart/assert' => '1.5.0@88e6d84706d09a236046d686bbea96f07b3a34f4',
  'laravel/laravel' => 'dev-master@d551602c8bddda2c9f6f8772cfbe0df58362ebd0',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new \OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}

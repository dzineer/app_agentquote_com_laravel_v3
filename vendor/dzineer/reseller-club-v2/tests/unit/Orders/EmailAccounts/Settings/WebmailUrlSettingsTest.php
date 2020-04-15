<?php

namespace Tests\Unit\Orders\EmailAccounts\Settings;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\EmailAccounts\Settings\WebmailUrlSettings;

class WebmailUrlSettingsTest extends TestCase
{
    public function testWebmailUrlSettings()
    {
        $webmailUrlSettings = new WebmailUrlSettings('http://webmail.somedomain.co.in.onlyfordemo.com');

        $this->assertEquals('http://webmail.somedomain.co.in.onlyfordemo.com', (string) $webmailUrlSettings);
    }
}

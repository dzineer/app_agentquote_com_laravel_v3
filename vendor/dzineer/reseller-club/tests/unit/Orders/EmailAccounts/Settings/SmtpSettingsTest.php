<?php

namespace Tests\Unit\Orders\EmailAccounts\Settings;

use PHPUnit\Framework\TestCase;
use DZResellerClub\Orders\EmailAccounts\Settings\SmtpSettings;

class SmtpSettingsTest extends TestCase
{
    public function testImapSettings()
    {
        $smtpSettings = new SmtpSettings('smtp.somedomain.co.in.onlyfordemo.com');

        $this->assertEquals('smtp.somedomain.co.in.onlyfordemo.com', (string) $smtpSettings);
    }
}

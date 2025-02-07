<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

namespace Flasher\Tests\Prime\Envelope\Stamp;

use Flasher\Prime\Notification\Envelope;
use Flasher\Prime\Stamp\UuidStamp;
use PHPUnit\Framework\TestCase;

final class UuidStampTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstruct()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamp = new UuidStamp();

        $envelop = new Envelope($notification, array($stamp));

        $this->assertEquals($stamp, $envelop->get('Flasher\Prime\Stamp\UuidStamp'));
        $this->assertInstanceOf('Flasher\Prime\Stamp\UuidStamp', $stamp);
        $this->assertNotEmpty($stamp->getUuid());
    }
}

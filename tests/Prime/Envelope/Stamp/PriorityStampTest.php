<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

namespace Flasher\Tests\Prime\Envelope\Stamp;

use Flasher\Prime\Notification\Envelope;
use Flasher\Prime\Stamp\HopsStamp;
use Flasher\Prime\Stamp\PriorityStamp;
use PHPUnit\Framework\TestCase;

final class PriorityStampTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstruct()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamp = new PriorityStamp(5);

        $envelop = new Envelope($notification, array($stamp));

        $this->assertEquals($stamp, $envelop->get('Flasher\Prime\Stamp\PriorityStamp'));
        $this->assertInstanceOf('Flasher\Prime\Stamp\StampInterface', $stamp);
        $this->assertEquals(5, $stamp->getPriority());
    }

    /**
     * @return void
     */
    public function testCompare()
    {
        $stamp1 = new PriorityStamp(1);
        $stamp2 = new PriorityStamp(2);

        $this->assertNotNull($stamp1->compare($stamp2));
        $this->assertEquals(1, $stamp1->compare(new HopsStamp(1)));
    }
}

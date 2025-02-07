<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

namespace Flasher\Tests\Prime\Envelope;

use Flasher\Prime\Notification\Envelope;
use PHPUnit\Framework\TestCase;

final class EnvelopeTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstruct()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamp = $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock();

        $envelope = new Envelope($notification, array($stamp));

        $this->assertEquals($notification, $envelope->getNotification());
        $this->assertEquals(array(\get_class($stamp) => $stamp), $envelope->all());
    }

    /**
     * @return void
     */
    public function testWith()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamp1 = $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock();
        $stamp2 = $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock();

        $envelope = new Envelope($notification);
        $envelope->with($stamp1, $stamp2);

        $this->assertEquals($notification, $envelope->getNotification());
        $this->assertEquals(array(\get_class($stamp1) => $stamp1, \get_class($stamp2) => $stamp2), $envelope->all());
    }

    /**
     * @return void
     */
    public function testWrap()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamp = $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock();

        $envelope = Envelope::wrap($notification, array($stamp));

        $this->assertEquals($notification, $envelope->getNotification());
        $this->assertEquals(array(\get_class($stamp) => $stamp), $envelope->all());
    }

    /**
     * @return void
     */
    public function testAll()
    {
        $notification = $this->getMockBuilder('Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamps = array(
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
        );

        $envelope = new Envelope($notification, $stamps);

        $this->assertEquals($notification, $envelope->getNotification());
        $this->assertEquals(array(\get_class($stamps[0]) => $stamps[3]), $envelope->all());
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $notification = $this->getMockBuilder('\Flasher\Prime\Notification\NotificationInterface')->getMock();
        $stamps = array(
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
            $this->getMockBuilder('Flasher\Prime\Stamp\StampInterface')->getMock(),
        );

        $envelope = new Envelope($notification, $stamps);

        $this->assertEquals($notification, $envelope->getNotification());

        $last = $envelope->get(\get_class($stamps[0]));

        $this->assertEquals($stamps[2], $last);
        $this->assertEquals($last, $envelope->get(\get_class($stamps[0])));

        $this->assertNull($envelope->get('NotFoundStamp')); // @phpstan-ignore-line
    }
}

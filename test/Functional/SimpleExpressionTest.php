<?php


namespace Hotdog\CalendarRecurringEvents\Functional;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\Schedule;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduleInterface;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\Event;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\ScheduledEventStorage;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression\SpecificDate;


class SimpleExpressionTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ScheduleInterface */
    protected $schedule;

    protected function setUp()
    {
        parent::setUp();
        $this->schedule = new Schedule(new ScheduledEventStorage());
        $this->schedule->addEvent(new Event('today'), new SpecificDate(new DateTime('today')));
        $this->schedule->addEvent(new Event('tomorrow'), new SpecificDate(new DateTime('tomorrow')));
        $this->schedule->addEvent(new Event('yesterday'), new SpecificDate(new DateTime('yesterday')));
    }

    /**
     * @dataProvider specificDayProvider
     */
    public function test_is_occurring($event, $date, $expected)
    {
        $this->assertEquals($expected, $this->schedule->isOccurring($event, $date));
    }

    public function specificDayProvider()
    {
        return array(
            array(new Event('today'), new DateTime('today'), true),
            array(new Event('today'), new DateTime('tomorrow'), false),

            array(new Event('tomorrow'), new DateTime('tomorrow'), true),
            array(new Event('tomorrow'), new DateTime('yesterday'), false),

            array(new Event('yesterday'), new DateTime('yesterday'), true),
            array(new Event('yesterday'), new DateTime('today'), false),
        );
    }
}

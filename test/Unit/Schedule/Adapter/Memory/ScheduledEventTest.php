<?php


namespace Hotdog\CalendarRecurringEvents\Unit\Schedule\Storage\Adapter\Memory;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduledEventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\Event;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\ScheduledEvent;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression\SpecificDate;

class ScheduledEventTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ScheduledEventInterface */
    protected $scheduled_event;

    protected function setUp()
    {
        parent::setUp();
        $this->scheduled_event = new ScheduledEvent(
            new Event('foo'),
            new SpecificDate(new DateTime('today')));
    }


    public function test_is_occurring_when_matching_both_event_and_temporal_expression()
    {
        $event = new Event('foo');
        $date = new DateTime('today');
        $this->assertTrue($this->scheduled_event->isOccurring($event, $date),
            "should occur when both event and date are matched");
    }

    public function test_is_not_occurring_when_event_does_not_match()
    {
        $event = new Event('bar');
        $date = new DateTime('today');
        $this->assertFalse($this->scheduled_event->isOccurring($event, $date),
            "should not occur when event is not matched");
    }

    public function test_is_not_occurring_when_temporal_expression_does_not_match()
    {
        $event = new Event('foo');
        $date = new DateTime('yesterday');
        $this->assertFalse($this->scheduled_event->isOccurring($event, $date),
            "should not occur when date is not matched");
    }
}

<?php


namespace Hotdog\CalendarRecurringEvents\Functional\Schedule\TemporalExpression;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\Schedule;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduleInterface;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\Event;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory\ScheduledEventStorage;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression\DayInMonth;

class DayInMonthTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ScheduleInterface */
    protected $schedule;

    protected function setUp()
    {
        parent::setUp();
        date_default_timezone_set('UTC');

        $this->schedule = new Schedule(new ScheduledEventStorage());

        $days = [
            'sunday' => DayInMonth::DAY_INDEX_SUNDAY,
            'monday' => DayInMonth::DAY_INDEX_MONDAY,
            'tuesday' => DayInMonth::DAY_INDEX_TUESDAY,
            'wednesday' => DayInMonth::DAY_INDEX_WEDNESDAY,
            'thursday' => DayInMonth::DAY_INDEX_THURSDAY,
            'friday' => DayInMonth::DAY_INDEX_FRIDAY,
            'saturday' => DayInMonth::DAY_INDEX_SATURDAY
        ];

        $counts = [
            'first' => 1,
            'second' => 2,
            'third' => 3,
            'fourth' => 4,
            'fifth' => 5,
            'last' => -1,
            'second to last' => -2,
            'third to last' => -3,
            'fourth to last' => -4,
            'fifth to last' => -5
        ];

        foreach($days as $event => $day_index)
        {
            foreach($counts as $event_prefix => $count)
            {
                $this->schedule->addEvent(new Event(sprintf("%s %s", $event_prefix, $event)),
                    new DayInMonth($count, $day_index));
            }
        }
    }

    /**
     * @dataProvider occurringProvider
     */
    public function test_is_occurring($event_name, $date_string, $expected)
    {
        $this->assertEquals($expected,
            $this->schedule->isOccurring(new Event($event_name), new DateTime($date_string)),
            sprintf("expected %s for %s on %s", $expected, $event_name, $date_string));
    }

    public function occurringProvider()
    {
        return [
            /* month starts on sunday */
            // first week
            ['first sunday', '2015-11-01', true],
            ['first wednesday', '2015-11-04', true],
            ['first saturday', '2015-11-07', true],

            // third week
            ['third sunday', '2015-11-15', true],
            ['third monday', '2015-11-16', true],
            ['third friday', '2015-11-20', true],

            // last week
            ['last sunday', '2015-11-29', true],
            ['last wednesday', '2015-11-25', true],
            ['last saturday', '2015-11-28', true],


            // third to last week
            ['third to last sunday', '2015-11-15', true],
            ['third to last monday', '2015-11-16', true],
            ['third to last thursday', '2015-11-12', true],

            /* month starts on wednesday */
            // first week
            ['first sunday', '2015-07-05', true],
            ['first saturday', '2015-07-04', true],
            ['first wednesday', '2015-07-01', true],

            // third week
            ['third sunday', '2015-07-19', true],
            ['third thursday', '2015-07-16', true],
            ['third friday', '2015-07-17', true],

            // last week
            ['last sunday', '2015-07-26', true],
            ['last wednesday', '2015-07-29', true],
            ['last saturday', '2015-07-25', true],

            // third to last week
            ['third to last sunday', '2015-07-12', true],
            ['third to last wednesday', '2015-07-15', true],
            ['third to last saturday', '2015-07-11', true],

            /* month starts on saturday */
            // first week
            ['first sunday', '2015-08-02', true],
            ['first wednesday', '2015-08-05', true],
            ['first saturday', '2015-08-01', true],

            // third week
            ['third tuesday', '2015-08-18', true],
            ['third thursday', '2015-08-20', true],
            ['third saturday', '2015-08-15', true],

            // last week
            ['last sunday', '2015-08-30', true],
            ['last wednesday', '2015-08-26', true],
            ['last saturday', '2015-08-29', true],

            // third to last week
            ['third to last sunday', '2015-08-16', true],
            ['third to last wednesday', '2015-08-12', true],
            ['third to last saturday', '2015-08-15', true],
        ];
    }
}

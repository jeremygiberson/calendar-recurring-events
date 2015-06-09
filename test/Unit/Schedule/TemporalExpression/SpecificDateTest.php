<?php


namespace Hotdog\CalendarRecurringEvents\Unit\Schedule\TemporalExpression;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression\SpecificDate;

class SpecificDateTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_true_for_matching_date()
    {
        $target_date = new DateTime('now');
        $matching_date = clone $target_date;
        $expression = new SpecificDate($target_date);
        $this->assertTrue($expression->includes($matching_date),
            "Should include specified date");
    }

    public function test_it_returns_false_for_a_non_matching_date()
    {
        $target_date = new DateTime('now');
        $non_matching_date = new DateTime('yesterday');
        $expression = new SpecificDate($target_date);
        $this->assertFalse($expression->includes($non_matching_date),
            "Should not include specified");
    }
}

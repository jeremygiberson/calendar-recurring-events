<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpressionInterface;

class DayInMonth implements TemporalExpressionInterface
{
    const DAY_INDEX_SUNDAY = 0;
    const DAY_INDEX_MONDAY = 1;
    const DAY_INDEX_TUESDAY = 2;
    const DAY_INDEX_WEDNESDAY = 3;
    const DAY_INDEX_THURSDAY = 4;
    const DAY_INDEX_FRIDAY = 5;
    const DAY_INDEX_SATURDAY = 6;

    /** @var  int */
    protected $count;
    /** @var  int */
    protected $day_index;

    /**
     * DayInMonth constructor.
     * @param int $count
     * @param int $day_index
     */
    public function __construct($count, $day_index)
    {
        $this->count = $count;
        $this->day_index = $day_index;
    }


    public function includes(DateTime $date)
    {
        return $this->dayMatches($date) && $this->weekMatches($date);
    }

    private function dayMatches(DateTime $date)
    {
        return $this->day_index == $date->format('w');
    }

    private function weekMatches(DateTime $date)
    {
        return $this->count > 0 ? $this->weekFromStartMatches($date) : $this->weekFromEndMatches($date);
    }

    private function weekFromStartMatches(DateTime $date)
    {
        $day_of_month = $date->format('j');
        return (int)(($day_of_month - 1) / 7) + 1;
    }

    private function weekFromEndMatches(DateTime $date)
    {
        $day_of_month = $date->format('j');
        $last_day = (int)$date->format('t');
        return (int)((($last_day - $day_of_month + 1) - 1) / 7) + 1;
    }
}
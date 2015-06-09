<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\TemporalExpression;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpressionInterface;

class SpecificDate implements TemporalExpressionInterface
{
    /** @var  DateTime */
    protected $date;

    /**
     * SpecificDate constructor.
     * @param DateTime $date
     */
    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }


    /**
     * @param DateTime $date
     * @return bool
     */
    public function includes(DateTime $date)
    {
        return $this->date == $date;
    }
}
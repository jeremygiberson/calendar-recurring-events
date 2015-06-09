<?php
namespace Hotdog\CalendarRecurringEvents\DateRange;

use DateTime;

class DateRange implements DateRangeInterface
{
    /** @var DateTime  */
    protected $start_date;
    /** @var DateTime  */
    protected $end_date;

    /**
     * @param DateTime $start_date
     * @param DateTime $end_date
     */
    public function __construct(DateTime $start_date, DateTime $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param DateTime $date
     * @return boolean
     */
    public function inRange(DateTime $date)
    {
        return $this->start_date <= $date && $date <= $this->end_date;
    }

    /**
     * Checks if this range overlaps with another
     * @param DateRange $range
     */
    public function overlaps(DateRange $range)
    {
        throw new \RuntimeException("Not yet implemented");
    }
}

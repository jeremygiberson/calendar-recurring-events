<?php
namespace Hotdog\CalendarRecurringEvents\DateRange;


use DateTime;

interface DateRangeInterface
{
    /**
     * @param DateTime $start_date
     * @param DateTime $end_date
     */
    public function __construct(DateTime $start_date, DateTime $end_date);

    /**
     * @return DateTime
     */
    public function getStartDate();

    /**
     * @return DateTime
     */
    public function getEndDate();

    /**
     * @param DateTime $date
     * @return boolean
     */
    public function inRange(DateTime $date);
}

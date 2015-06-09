<?php


namespace Hotdog\CalendarRecurringEvents\Schedule;


use DateTime;
use Hotdog\CalendarRecurringEvents\DateRange\DateRange;
use Hotdog\CalendarRecurringEvents\DateRange\DateRangeInterface;


abstract class ScheduleAbstract implements ScheduleInterface
{
    /**
     * {@inheritDoc}
     */
    public function isOccurring(EventInterface $event, DateTime $date)
    {
        foreach($this->getScheduledEvents() as $element)
        {
            if($element->isOccurring($event, $date))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function occurrences(EventInterface $event, DateRangeInterface $during)
    {
        $dates = [];
        foreach($during as $date)
        {
            if($this->isOccurring($event, $date))
            {
                $dates[] = $date;
            }
        }
        return $dates;
    }

    /**
     * {@inheritDoc}
     */
    public function nextOccurrence(EventInterface $event, DateTime $after_date, DateTime $upper_bound_date = null)
    {
        $end_date = $upper_bound_date ?: new DateTime('+10 years');
        $range = new DateRange($after_date, $end_date);
        foreach($range as $date)
        {
            if($this->isOccurring($event, $date))
            {
                return $date;
            }
        }
        return null;
    }

}
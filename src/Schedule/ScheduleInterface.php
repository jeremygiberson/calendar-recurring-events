<?php
namespace Hotdog\CalendarRecurringEvents\Schedule;


use DateTime;
use Hotdog\CalendarRecurringEvents\DateRange\DateRange;
use Hotdog\CalendarRecurringEvents\DateRange\DateRangeInterface;


interface ScheduleInterface
{
    /**
     * Check if an event occurs on $date
     * @param EventInterface $event
     * @param DateTime $date
     * @return bool
     */
    public function isOccurring (EventInterface $event, DateTime $date);

    /**
     *
     * @param EventInterface $event
     * @param DateRangeInterface $during
     * @return DateTime[]
     */
    public function occurrences (EventInterface $event, DateRangeInterface $during);

    /**
     * Find next occurring date for $event following $after_date up to $upper_bound_$date
     * @param EventInterface $event
     * @param DateTime $date
     */
    public function nextOccurrence (EventInterface $event, DateTime $date);

    /**
     * @param EventInterface $event
     * @param TemporalExpressionInterface $expression
     * @return ScheduledEventInterface
     */
    public function addEvent(EventInterface $event, TemporalExpressionInterface $expression);

    /**
     * @param EventInterface $event
     */
    public function removeEvent(EventInterface $event);

    /**
     * @param DateRange $filter_range optionally provide a range of dates, that at least partially fall within the
     * start and end constraints of the scheduled event temporal expression, to filter results
     *
     * @return ScheduledEventInterface[]
     */
    public function getScheduledEvents(DateRange $filter_range = null);
}

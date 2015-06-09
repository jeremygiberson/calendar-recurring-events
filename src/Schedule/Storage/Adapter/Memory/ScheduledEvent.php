<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory;


use DateTime;
use Hotdog\CalendarRecurringEvents\Schedule\EventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduledEventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduledEventTrait;

class ScheduledEvent implements ScheduledEventInterface
{
    use ScheduledEventTrait;

    /**
     * @param EventInterface $event
     * @param DateTime $date
     * @return mixed
     */
    public function isOccurring(EventInterface $event, DateTime $date)
    {
        return $this->getEvent() == $event && $this->getTemporalExpression()->includes($date);
    }
}
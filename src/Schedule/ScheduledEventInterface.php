<?php
namespace Hotdog\CalendarRecurringEvents\Schedule;


use DateTime;

interface ScheduledEventInterface
{
    /**
     * @return EventInterface
     */
    public function getEvent();

    /**
     * @return TemporalExpressionInterface
     */
    public function getTemporalExpression();

    /**
     * @param EventInterface $event
     * @param DateTime $date
     * @return mixed
     */
    public function isOccurring(EventInterface $event, DateTime $date);
}

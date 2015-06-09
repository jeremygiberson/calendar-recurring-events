<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\Storage;


use DomainException;
use Hotdog\CalendarRecurringEvents\DateRange\DateRange;
use Hotdog\CalendarRecurringEvents\Schedule\EventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduledEventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpressionInterface;

interface ScheduledEventStorageInterface
{
    /**
     * @param EventInterface $event
     * @param TemporalExpressionInterface $expression
     * @return ScheduledEventInterface
     */
    public function create(EventInterface $event, TemporalExpressionInterface $expression);

    /**
     * @param ScheduledEventInterface $scheduled_event
     */
    public function save(ScheduledEventInterface $scheduled_event);

    /**
     * @param ScheduledEventInterface $scheduled_event
     */
    public function remove(ScheduledEventInterface $scheduled_event);

    /**
     * @param EventInterface $event
     * @return ScheduledEventInterface
     * @throws DomainException if can't find scheduled_event
     */
    public function fetch(EventInterface $event = null);

    /**
     * @param DateRange $overlapping_range
     * @return ScheduledEventInterface[]
     */
    public function fetchRange(DateRange $overlapping_range = null);

    /**
     * @return ScheduledEventInterface[]
     */
    public function fetchAll();
}
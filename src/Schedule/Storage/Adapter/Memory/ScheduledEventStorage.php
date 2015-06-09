<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory;


use DomainException;
use Hotdog\CalendarRecurringEvents\DateRange\DateRange;
use Hotdog\CalendarRecurringEvents\Schedule\EventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\ScheduledEventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\ScheduledEventStorageInterface;
use Hotdog\CalendarRecurringEvents\Schedule\TemporalExpressionInterface;
use RuntimeException;
use SplObjectStorage;

class ScheduledEventStorage implements ScheduledEventStorageInterface
{
    /** @var  \SplObjectStorage */
    protected $scheduled_events;

    /**
     * ScheduledEventStorage constructor.
     */
    public function __construct()
    {
        $this->scheduled_events = new SplObjectStorage();
    }


    /**
     * @param EventInterface $event
     * @param TemporalExpressionInterface $expression
     * @return ScheduledEventInterface
     */
    public function create(EventInterface $event, TemporalExpressionInterface $expression)
    {
        $se = new ScheduledEvent($event, $expression);
        $this->scheduled_events->attach($se);
    }

    /**
     * @param ScheduledEventInterface $scheduled_event
     */
    public function save(ScheduledEventInterface $scheduled_event)
    {
        $this->scheduled_events->attach($scheduled_event);
    }

    /**
     * @param ScheduledEventInterface $scheduled_event
     */
    public function remove(ScheduledEventInterface $scheduled_event)
    {
        $this->scheduled_events->detach($scheduled_event);
    }

    /**
     * @param EventInterface $event
     * @return ScheduledEventInterface
     * @throws DomainException if can't find scheduled_event
     */
    public function fetch(EventInterface $event = null)
    {
        /** @var ScheduledEventInterface $scheduled_event */
        foreach($this->scheduled_events as $scheduled_event)
        {
            if($scheduled_event->getEvent() === $event)
            {
                return $scheduled_event;
            }
        }
        throw new DomainException(sprintf("could not find scheduled event matching event"));
    }

    /**
     * @param DateRange $overlapping_range
     * @return ScheduledEventInterface[]
     */
    public function fetchRange(DateRange $overlapping_range = null)
    {
        // TODO: Implement fetchRange() method.
        throw new RuntimeException("Not Implemented");
        // foreach($this->fetchAll())
        // if $sc->getTemporalExpression()->hasRangeConstraint() &&
        // $sc->getTemporalExpression()->getRangeConstraint()->overlaps($overlapping_range)
        //  include in results
    }

    /**
     * @return ScheduledEventInterface[]
     */
    public function fetchAll()
    {
        $scheduled_events = [];
        foreach($this->scheduled_events as $scheduled_event)
        {
            $scheduled_events[] = $scheduled_event;
        }
        return $scheduled_events;
    }
}
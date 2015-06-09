<?php


namespace Hotdog\CalendarRecurringEvents\Schedule;


use Hotdog\CalendarRecurringEvents\DateRange\DateRange;
use Hotdog\CalendarRecurringEvents\Schedule\Storage\ScheduledEventStorageInterface;

class Schedule extends ScheduleAbstract
{
    /** @var  ScheduledEventStorageInterface */
    protected $storage;

    /**
     * Schedule constructor.
     * @param ScheduledEventStorageInterface $storage
     */
    public function __construct(ScheduledEventStorageInterface $storage)
    {
        $this->storage = $storage;
    }


    /**
     * @param EventInterface $event
     * @param TemporalExpressionInterface $expression
     * @return ScheduledEventInterface
     */
    public function addEvent(EventInterface $event, TemporalExpressionInterface $expression)
    {
        $se = $this->storage->create($event, $expression);
        return $se;
    }

    /**
     * Removes a scheduled event, or no opp if event not scheduled
     * @param EventInterface $event
     * @throws \Exception if storage operation fails
     */
    public function removeEvent(EventInterface $event)
    {
        try
        {
            $scheduled_event = $this->storage->fetch($event);
            $this->storage->remove($scheduled_event);
        } catch (\DomainException $e)
        {
            return;
        } catch (\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * @param DateRange $filter_range optionally provide a range of dates, that at least partially fall within the
     * start and end constraints of the scheduled event temporal expression, to filter results
     *
     * @return ScheduledEventInterface[]
     */
    public function getScheduledEvents(DateRange $filter_range = null)
    {
        return $filter_range ? $this->storage->fetchRange($filter_range) : $this->storage->fetchAll();
    }
}
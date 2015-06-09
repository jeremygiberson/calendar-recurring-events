<?php


namespace Hotdog\CalendarRecurringEvents\Schedule;

trait ScheduledEventTrait
{
    /** @var  EventInterface */
    private $event;
    /** @var  TemporalExpressionInterface */
    private $temporal_expression;

    /**
     * ScheduledEventTrait constructor.
     * @param EventInterface $event
     * @param TemporalExpressionInterface $temporal_expression
     */
    public function __construct(EventInterface $event, TemporalExpressionInterface $temporal_expression)
    {
        $this->event = $event;
        $this->temporal_expression = $temporal_expression;
    }

    /**
     * @return EventInterface
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return TemporalExpressionInterface
     */
    public function getTemporalExpression()
    {
        return $this->temporal_expression;
    }

}
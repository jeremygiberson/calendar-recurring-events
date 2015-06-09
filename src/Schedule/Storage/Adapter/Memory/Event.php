<?php


namespace Hotdog\CalendarRecurringEvents\Schedule\Storage\Adapter\Memory;


use Hotdog\CalendarRecurringEvents\Schedule\EventInterface;
use Hotdog\CalendarRecurringEvents\Schedule\EventTrait;

class Event implements EventInterface
{
    use EventTrait;
}
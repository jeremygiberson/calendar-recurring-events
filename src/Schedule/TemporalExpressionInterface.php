<?php
namespace Hotdog\CalendarRecurringEvents\Schedule;


use DateTime;

interface TemporalExpressionInterface
{
    public function includes(DateTime $date);
}

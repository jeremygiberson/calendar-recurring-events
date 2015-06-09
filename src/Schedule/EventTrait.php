<?php


namespace Hotdog\CalendarRecurringEvents\Schedule;


trait EventTrait
{
    private $name;

    /**
     * EventTrait constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}
<?php
namespace Hotdog\CalendarRecurringEvents\DateRange;


use DateInterval;
use DateTime;

class DailyIterator implements \Iterator
{
    /** @var  DateRangeInterface */
    protected $date_range;
    /** @var  int */
    protected $index;

    /**
     * DailyIterator constructor.
     * @param DateRangeInterface $date_range
     */
    public function __construct(DateRangeInterface $date_range)
    {
        if($date_range->getEndDate() < $date_range->getStartDate())
        {
            throw new \RuntimeException(sprintf("Iterator only supports positive date ranges"));
        }
        $this->date_range = $date_range;
    }

    /**
     * @return DateRangeInterface
     */
    public function getDateRange()
    {
        return $this->date_range;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return DateTime|null Can return any type.
     */
    public function current()
    {
        $interval = new DateInterval(sprintf('P%sD', $this->index));
        $current_date = $this->date_range->getStartDate()->add($interval);
        if($current_date > $this->date_range->getEndDate())
        {
            return null;
        }
        return $current_date;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $interval = new DateInterval(sprintf('P%sD', $this->index));
        $current_date = $this->date_range->getStartDate()->add($interval);
        return ($current_date > $this->date_range->getEndDate());
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->index = 0;
    }
}

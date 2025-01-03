<?php
namespace App\Traits;

use Carbon\Carbon;
use DateTime;

trait DateFormatTrait
{
    /**
     * Format a given date into 'd-m-Y H:i:s' format.
     *
     * @param  \DateTime  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::instance($date)->format('d-m-Y H:i:s');
    }
}

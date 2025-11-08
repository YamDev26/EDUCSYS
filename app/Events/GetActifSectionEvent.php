<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetActifSectionEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $year, $today;
    public function __construct($year, $today)
    {
        $this->year = $year;
        $this->today = $today;
    }
}

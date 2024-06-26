<?php

namespace App\Scheduler;

use App\Scheduler\Message\DailyLoadProducts;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule]
class ScheduleProvider implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
         // every day at 00:00
        return (new Schedule())->add(
            RecurringMessage::cron('0 0 * * *', new DailyLoadProducts()),
        );
    }
}
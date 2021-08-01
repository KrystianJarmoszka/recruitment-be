<?php

namespace App\Entity\Constants;

/**
 * Interface JobStatuses
 * @package App\Entity\Constants
 */
interface JobStatuses
{
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    const JOB_STATUSES = [
        self::STATUS_OPEN,
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELED,
    ];
}

<?php

namespace App\Contracts\Interfaces;

use App\Models\ActivityLog;
use Illuminate\Support\Collection;

interface ActivityLogRepositoryInterface
{
    /**
     * Log an activity.
     */
    public function log(
        string $action,
        string $entityType,
        ?string $entityId,
        string $description
    ): ActivityLog;

    /**
     * Get recent activity logs.
     */
    public function getRecent(int $limit = 10): Collection;
}

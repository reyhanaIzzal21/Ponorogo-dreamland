<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ActivityLogRepositoryInterface;
use App\Models\ActivityLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    /**
     * Log an activity.
     */
    public function log(
        string $action,
        string $entityType,
        ?string $entityId,
        string $description
    ): ActivityLog {
        return ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'description' => $description,
        ]);
    }

    /**
     * Get recent activity logs.
     */
    public function getRecent(int $limit = 10): Collection
    {
        return ActivityLog::with('user')
            ->latest()
            ->limit($limit)
            ->get();
    }
}

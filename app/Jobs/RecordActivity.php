<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecordActivity implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Team $team;
    protected User $user;
    protected ?Project $project;
    protected ?Target $target;
    protected ?Environment $environment;
    protected string $transaction;
    protected string $status;
    protected ?string $reason;
    protected ?string $currentValue;
    protected ?string $originalValue;

    public function __construct(
        Team $team,
        User $user,
        ?Project $project,
        ?Target $target,
        ?Environment $environment,
        string $transaction,
        string $status = 'success',
        ?string $reason = null,
        ?string $currentValue = null,
        ?string $originalValue = null
    ) {
        $this->team = $team;
        $this->user = $user;
        $this->project = $project;
        $this->target = $target;
        $this->environment = $environment;
        $this->transaction = $transaction;
        $this->status = $status;
        $this->reason = $reason;
        $this->currentValue = $currentValue;
        $this->originalValue = $originalValue;
    }

    public function handle(): void
    {
        Activity::create([
            'team_id' => $this->team->id,
            'user_id' => $this->user->id,
            'project_id' => $this->project?->id,
            'target_id' => $this->target?->id,
            'environment_id' => $this->environment?->id,
            'transaction' => $this->transaction,
            'status' => $this->status,
            'reason' => $this->reason,
            'team_model' => $this->team->toArray(),
            'user_model' => $this->team->toArray(),
            'project_model' => $this->project?->toArray(),
            'target_model' => $this->target?->toArray(),
            'environment_model' => $this->environment?->toArray(),
            'current' => $this->currentValue,
            'original' => $this->originalValue,
        ]);
    }
}

<?php

namespace App\Observers;

use App\Models\Target;

class TargetObserver
{
    public function creating(Target $target): void
    {
        //
    }

    public function created(Target $target): void
    {
        $target->environments()->createMany([
            [
                'name' => 'Production',
                'notes' => 'Default Production Environment',
            ],
            [
                'name' => 'Staging',
                'notes' => 'Default Staging Environment',
            ],
            [
                'name' => 'Develop',
                'notes' => 'Default Develop Environment',
            ],
        ]);
    }

    public function updated(Target $target): void
    {
        //
    }

    public function deleted(Target $target): void
    {
        //
    }

    public function restored(Target $target): void
    {
        //
    }
}

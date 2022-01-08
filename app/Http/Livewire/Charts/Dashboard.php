<?php

namespace App\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Dashboard extends Component
{
    public array $types = [
        'activity',
    ];

    public array $colors = [
        'Project' => '#818cf8',
        'Target' => '#a78bfa',
        'Environment' => '#c084fc',
    ];

    public bool $firstRun = true;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $columnChartModel = Activity::where('team_id', currentTeam('id'))->get()
            ->groupBy('subject_type')
            ->reduce(function (ColumnChartModel $columnChartModel, $activityType) {
                $type = Str::of($activityType->first()->subject_type)->afterLast('\\');

                return $columnChartModel->addColumn(
                    $type->plural(),
                    $activityType->count(),
                    $this->colors[(string) $type]
                );
            }, (new ColumnChartModel())
                ->setTitle('Activities')
                ->setAnimated($this->firstRun));

        $this->firstRun = false;

        return view('livewire.charts.dashboard')
            ->with([
                'columnChartModel' => $columnChartModel,
            ]);
    }
}

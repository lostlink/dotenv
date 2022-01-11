<?php

namespace App\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Dashboard extends Component
{
    public bool $firstRun = true;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $range = CarbonPeriod::start(Carbon::now()->subDays(10))->untilNow();
        $activities = Activity::where('team_id', currentTeam('id'))
            ->whereBetween('created_at', [$range->start, $range->end])
            ->get()
            ->map(fn ($row) => $row->setAttribute('date', Carbon::parse($row->getAttribute('created_at'))->format('Y-m-d')))
            ->groupBy('date');

        $columnChartModel = collect($range)
            ->reduce(function (ColumnChartModel $columnChartModel, $date) use ($activities) {
                return $columnChartModel->addColumn(
                    $date->format('Y-m-d'),
                    $activities->get($date->format('Y-m-d'))?->count() ?? 0,
                    '#4b5563'
                );
            }, (new ColumnChartModel())
                ->setTitle('Activities')
                ->setAnimated($this->firstRun))
                ->withoutLegend();

        $this->firstRun = false;

        return view('livewire.charts.dashboard')
            ->with([
                'columnChartModel' => $columnChartModel,
            ]);
    }
}

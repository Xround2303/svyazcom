<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ModelBill;
use App\Models\ModelPeriod;
use Carbon\Carbon;
use Database\Factories\ModelReriodTariffFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ModelPeriod::create([
            "begin_date" => Carbon::now()->subMonths(2)->startOfMonth(),
            "end_date" => Carbon::now()->subMonths(2)->endOfMonth()
        ]);

        for ($i = 0; $i < 100; $i++) {
            $this->createUniquePeriod();
        }

        ModelBill::factory(100)->create();
    }

    // Создаем последовательно периоды месяцев
    protected function createUniquePeriod(): ModelPeriod
    {
        if(!$modelPeriodFirst = ModelPeriod::query()->orderBy("begin_date", "ASC")->first()) {
            return ModelPeriod::create([
                "begin_date" => Carbon::now()->startOfMonth(),
                "end_date" => Carbon::now()->endOfMonth()
            ]);
        }

        list($beginDate, $endDate) = $this->getStartAndEndUnique(
            $modelPeriodFirst->begin_date,
            $modelPeriodFirst->end_date
        );

        return ModelPeriod::create([
            "begin_date" => $beginDate,
            "end_date" => $endDate
        ]);
    }

    protected function getStartAndEndUnique(string $beginDate, string $endDate): array
    {
        $start = Carbon::parse($beginDate)->subMonth()->startOfMonth();
        $end = Carbon::parse($beginDate)->subMonth()->endOfMonth();

        $modelPeriod = ModelPeriod::query()
            ->where([
                "begin_date" => $start,
                "end_date" => $end
            ])
            ->first();

        if(!$modelPeriod) {
            return [
                $start,
                $end
            ];
        }

        return $this->getStartAndEndUnique(
            $modelPeriod->begin_date,
            $modelPeriod->end_date
        );
    }
}

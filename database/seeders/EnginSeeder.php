<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\Engin;
use App\Models\Mission;
use Illuminate\Database\Seeder;

class EnginSeeder extends Seeder
{
    const ENGINS = [
        ['no_parc' => 'VSAV0168', 'centre' => 'AUP', 'missions' => ['SAP']],
        ['no_parc' => 'VSAV0123', 'centre' => 'SLS', 'missions' => ['SAP']],
        ['no_parc' => 'VIPSR002', 'centre' => 'AUP', 'missions' => ['INC', 'SR', 'FDF']],
        ['no_parc' => 'VIP00012', 'centre' => 'SLS', 'missions' => ['INC', 'FDF']],
        ['no_parc' => 'VSAV0047', 'missions' => ['SAP']],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::ENGINS as $ENGIN) {
            /** @var Engin $engin */
            $engin = Engin::make([
                'no_parc' => $ENGIN['no_parc']
            ]);
            if (!empty($ENGIN['centre'])) {
                $engin->centre()->associate(Centre::where('libelle_court', $ENGIN['centre'])->firstOrFail());
            }
            $engin->save();

            if (!empty($ENGIN['missions']) && Mission::count()) {
                foreach ($ENGIN['missions'] as $mission) {
                    $engin->missions()->attach(Mission::where('libelle', $mission)->firstOrFail());
                }
            }
        }
    }
}

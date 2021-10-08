<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\Engin;
use Illuminate\Database\Seeder;

class EnginSeeder extends Seeder
{
    const ENGINS = [
        ['no_parc' => 'VSAV0168', 'centre' => 'AUP'],
        ['no_parc' => 'VSAV0123', 'centre' => 'SLS'],
        ['no_parc' => 'VIPSR002', 'centre' => 'AUP'],
        ['no_parc' => 'VIP00012', 'centre' => 'SLS'],
        ['no_parc' => 'VSAV0047'],
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
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Plano;

class PlanoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plano::truncate();
        $planos = [
            ['nome' => 'Free', 'mensalidade' => 0,],
            ['nome' => 'basic', 'mensalidade' => 100,],
            ['nome' => 'Plus', 'mensalidade' => 187,],
        ];
        foreach($planos as $plano) {
            Plano::create([
                'nome' => $plano['nome'],
                'mensalidade' => $plano['mensalidade'],
            ]);
        }
    }
}

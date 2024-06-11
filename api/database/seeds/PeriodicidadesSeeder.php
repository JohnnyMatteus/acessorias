<?php

use App\Model\Periodicidade;
use Illuminate\Database\Seeder;

class PeriodicidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Periodicidade::firstOrCreate([
            "periodo" => 'Diaria'
        ],[
            'nome' => 'Diária',
            'periodo' => 'Diaria',
            'tipo'  => 'DAY',
            'dias' => '1',
            'descricao' => 'Atividades diarias'
        ]);

        Periodicidade::firstOrCreate([
            "periodo" => 'Semanal'
        ],[
            'nome' => 'Semanal',
            'periodo' => 'Semanal',
            'tipo'  => 'WEEK',
            'dias' => '7',
            'descricao' => 'Atividades semanais'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Mensal'
        ],[
            'nome' => 'Semanal',
            'periodo' => 'Mensal',
            'tipo'  => 'WEEK',
            'dias' => '30',
            'descricao' => 'Atividades mensal'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Bimestral'
        ],[
            'nome' => 'Bimestral',
            'periodo' => 'Bimestral',
            'tipo'  => 'MONTH',
            'dias' => '60',
            'descricao' => 'Atividades bimestral'
        ]);

        Periodicidade::firstOrCreate([
            "periodo" => 'Trimestral'
        ],[
            'nome' => 'Trimestral',
            'periodo' => 'Trimestral',
            'tipo'  => 'MONTH',
            'dias' => '90',
            'descricao' => 'Atividades trimestral'
        ]);

        Periodicidade::firstOrCreate([
            "periodo" => 'Semestral'
        ],[
            'nome' => 'Semestral',
            'periodo' => 'Semestral',
            'tipo'  => 'MONTH',
            'dias' => '180',
            'descricao' => 'Atividades semestral'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Anual'
        ],[
            'nome' => 'Anual',
            'periodo' => 'Anual',
            'tipo'  => 'MONTH',
            'dias' => '365',
            'descricao' => 'Atividades anual'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Quinzenal'
        ],[
            'nome' => 'Quinzenal',
            'periodo' => 'Quinzenal',
            'tipo'  => 'DAY',
            'dias' => '15',
            'descricao' => 'Atividades quinzenal'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Bienal'
        ],[
            'nome' => 'Bienal',
            'periodo' => 'Bienal',
            'tipo'  => 'YEAR',
            'dias' => '730',
            'descricao' => 'Atividades bienal'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Trienal'
        ],[
            'nome' => 'Trienal',
            'periodo' => 'Trienal',
            'tipo'  => 'YEAR',
            'dias' => '1095',
            'descricao' => 'Atividades trienal'
        ]);

        Periodicidade::firstOrCreate([
            "periodo" => 'Quinquenal'
        ],[
            'nome' => 'Quinquenal',
            'periodo' => 'Quinquenal',
            'tipo'  => 'YEAR',
            'dias' => '1095',
            'descricao' => 'Atividades quinquenal'
        ]);
        Periodicidade::firstOrCreate([
            "periodo" => 'Quadrimestral'
        ],[
            'nome' => 'Quadrimestral',
            'periodo' => 'Quadrimestral',
            'tipo'  => 'YEAR',
            'dias' => '1095',
            'descricao' => 'Atividades quadrimestral'
        ]);

        Periodicidade::firstOrCreate([
            "periodo" => 'Quadrimestral'
        ],[
            'nome' => 'Quadrimestral',
            'periodo' => 'Quadrimestral',
            'tipo'  => 'MONTH',
            'dias' => '120',
            'descricao' => 'Atividades quadrimestral'
        ]);
       
    }
}


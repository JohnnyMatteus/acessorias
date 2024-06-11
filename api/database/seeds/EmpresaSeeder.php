<?php

use App\Model\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::firstOrCreate([
            "name" => "Empresa 01"
        ],[
            'name'  => 'Empresa 01',
            'fone'  => '3100000000',
            'cell'  => '31900009999', 
            'status'    => 'A', 
            'logo'  => 'padrao.png', 
            'access_name'   => 'empresa01', 
            'description'   => 'Empresa dona do negocio.', 
            'email' => 'financeiro@empresa01.com', 
            'name_responsible'  => 'Usuário API',        
            'site'  => 'empresa.com.br', 
            'slug'  => 'empresa_principal', 
        ]);
    }
}

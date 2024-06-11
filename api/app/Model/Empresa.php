<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\TenantModels;
use App\Model\Uuid;

class Empresa extends Model
{
    use TenantModels, Uuid;
    protected $table = 'empresas';
    protected $guarded = ['id'];

    protected $fillable = [
        'id', 
        'uuid',
        'name',
        'fone',
        'cell', 
        'status', 
        'logo', 
        'access_name', 
        'description', 
        'email', 
        'name_responsible',        
        'site', 
        'slug', 
        'created_at',	
        'updated_at'
    ];
}

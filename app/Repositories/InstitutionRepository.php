<?php 

namespace App\Repositories;

use App\Models\Institution;

class InstitutionRepository
{
    public function create(array $data): ?Institution
    {
        return Institution::create($data);
    }

    public function findByCNPJ(string $cnpj): ?Institution
    {
        return Institution::where('cnpj', $cnpj)->first();
    }
}
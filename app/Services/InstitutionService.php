<?php 

namespace App\Services;

use App\Exceptions\ExternalAPI\ErrorApiExternalException;
use App\Exceptions\Institution\InvalidInstitutionException;
use Illuminate\Support\Facades\Http;
use App\Exceptions\ExternalAPI\InstitutionNotFoundApiException;
use App\Exceptions\Institution\InstitutonCreateException;
use App\Models\Institution;
use App\Repositories\InstitutionRepository;

class InstitutionService
{
    public function  __construct(
        protected InstitutionRepository $institutionRepository
    )
    {}

    public function validateInstitution(String $cnpj): array
    {   
        $alreadyExist = self::getByCNPJ($cnpj);

        if($alreadyExist)
        {
            return [
                'id' => $alreadyExist->id,
                'nome' => $alreadyExist->name,
                'uf' => $alreadyExist->city,
                'municipio' => $alreadyExist->state,
                'logradouro' => $alreadyExist->address,
                'bairro' => $alreadyExist->neighborhood,
                'numero' => $alreadyExist->number,  
                'alreadyExist' => true
            ];
        }

        $url = env('URL_INSTITUTION_VALIDATOR') . $cnpj;
        $validCod = ["85.32-5-00", "85.31-7-00", "85.53-3-00"];

        $response = Http::get($url);

        if($response->status() === 404)
        {
            throw new InstitutionNotFoundApiException($cnpj);
        }

        if($response->status() !== 200)
        {
            throw new ErrorApiExternalException($cnpj);
        }

        $data = $response->json();

        $code1 = data_get($data, 'atividade_principal.0.code');
        $code2 = data_get($data, 'atividades_secundarias.0.code');

        if (in_array($code1, $validCod)) {
            return $data; 
        }

        if(in_array($code2, $validCod))
        {
            return array($data);
        }

        throw new InvalidInstitutionException($cnpj);
    }

    public function create(array $data): Institution
    {
        $institution = $this->institutionRepository->create($data);

        if(!$institution)
        {
            throw new InstitutonCreateException($data['cnpj']);
        }

        return $institution;
    }

    public function getByCNPJ(string $cnpj): ?Institution
    {
        $institution = $this->institutionRepository->findByCNPJ($cnpj);

        return $institution;
    }
}
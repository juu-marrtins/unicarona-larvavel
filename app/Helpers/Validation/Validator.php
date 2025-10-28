<?php 

namespace App\Helpers\Validation;

use App\Exceptions\Validator\InvalidCNPJException;
use App\Exceptions\Validator\InvalidCPFException;
use App\Exceptions\Validator\InvalidEmailInstitutional;

class Validator
{   
    public static function cleanDigits(String $value): ?String
    {
        return preg_replace('/\D/', '', $value);
    }

    public static function validateCPF(String $cpf): ?String
    {
        if (strlen($cpf) != 11) {
            throw new InvalidCPFException($cpf);
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new InvalidCPFException($cpf);
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = $remainder < 2 ? 0 : 11 - $remainder;

        if ($digit1 != intval($cpf[9])) {
            throw new InvalidCPFException($cpf);
        }
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }
        $remainder = $sum % 11;
        $digit2 = $remainder < 2 ? 0 : 11 - $remainder;
        
        if ($digit2 != intval($cpf[10])) {
            throw new InvalidCPFException($cpf);
        }

        return $cpf;
    }

    public static function validateCNPJ(String $cnpj): ?String
    {
        if (strlen($cnpj) != 14) {
            throw new InvalidCNPJException($cnpj);
        }

        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            throw new InvalidCNPJException($cnpj);
        }

        $length = strlen($cnpj) - 2;
        $numbers = substr($cnpj, 0, $length);
        $digits = substr($cnpj, $length);
        $sum = 0;
        $position = $length - 7;
        
        for ($i = $length; $i >= 1; $i--) {
            $sum += intval($numbers[$length - $i]) * $position--;
            if ($position < 2) {
                $position = 9;
            }
        }
        
        $result = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
        
        if ($result != intval($digits[0])) {
            throw new InvalidCNPJException($cnpj);
        }

        $length = $length + 1;
        $numbers = substr($cnpj, 0, $length);
        $sum = 0;
        $position = $length - 7;
        
        for ($i = $length; $i >= 1; $i--) {
            $sum += intval($numbers[$length - $i]) * $position--;
            if ($position < 2) {
                $position = 9;
            }
        }
        
        $result = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
        
        if ($result != intval($digits[1])) {
            throw new InvalidCNPJException($cnpj);
        }

        return $cnpj;
    }

    public static function validateEmailInstitutional(String $email): ?String
    {
        $domain = explode('@', $email)[1];

        if($domain !== "edu.br"){
            throw new InvalidEmailInstitutional($email);
        }

        return $email;
    }
}
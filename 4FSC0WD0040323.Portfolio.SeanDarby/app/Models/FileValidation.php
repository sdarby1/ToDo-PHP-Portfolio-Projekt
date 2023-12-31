<?php

namespace App\Models;

use Exception;

class FileValidation {
    private array $rules;
    private array $errors = [];
    private array $allowedTypes = [
        'image' => [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png'
        ]
    ];

    public function __construct(private array $inputFiles)
    {

    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(): void
    {
        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);

            if (!in_array('required', $fieldRules) && !$this->fieldExists($field)) {
                continue;
            }

            $this->validateField($field, $fieldRules);
        }
    }

    private function validateField(string $field, array $fieldRules): void
    {

        usort($fieldRules, function ($firstRule, $secondRule) {
            if ($firstRule === 'required') {
                return -1;
            }

            return 1;
        });

        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);
            $fieldRuleName = $ruleSegments[0];
      
            $satisfier = $ruleSegments[1] ?? null;

            if (!method_exists(FileValidation::class, $fieldRuleName)) {
                trigger_error("The rule you tried to use does not exist: $fieldRuleName");
                continue;
            }

            try {
                $this->{$fieldRuleName}($field, $satisfier);
            } catch (Exception $e) {
                $this->errors[$field][] = $e->getMessage();

                if ($fieldRuleName === 'required') break;
            }
        }
    }

    private function fieldExists($field)
    {
        return isset($this->inputFiles[$field]) && $this->inputFiles[$field]['size'] > 0;
    }

    private function required($field): void
    {
        if (!$this->fieldExists($field)) {
            throw new Exception("❌ Dieses Feld ist ein Pflichtfeld.");
        }
    }

    private function type($field, $satisfier): void
    {
        $allowedExtensions = array_keys($this->allowedTypes[$satisfier]);
        $extension = pathinfo($this->inputFiles[$field]['name'], PATHINFO_EXTENSION);

        if (!in_array($extension, $allowedExtensions)) {
            throw new Exception("❌ Das {$field} Feld muss dem Typen {$satisfier} entsprechen.");
        }

        $currentLocation = $this->inputFiles[$field]['tmp_name'];
        $mimeType = mime_content_type($currentLocation);
        $allowedMimeType = $this->allowedTypes[$satisfier][$extension];

        if ($mimeType !== $allowedMimeType) {
            throw new Exception("❌ Das {$field} Feld muss dem Typen {$satisfier} entsprechen.");
        }
    }

    private function maxsize($field, $satisfier)
    {
        if ($this->inputFiles[$field]['size'] > (int) $satisfier) {
            throw new Exception("❌ Das {$field} Darf nicht größer {$satisfier} bytes sein.");
        }
    }
}

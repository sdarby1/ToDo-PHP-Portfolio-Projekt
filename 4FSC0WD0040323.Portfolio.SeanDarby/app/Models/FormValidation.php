<?php

namespace App\Models;

use App\Helpers\Session;
use Exception;

class FormValidation {
    private array $errors = [];
    private array $rules;
    private array $messages = [];


    public function __construct(private array $formInput)
    {}

    public function setRules (array $rules): void
    {
        $this->rules = $rules;
    }

    public function setMessages(array $messages): void
    {
        $this->messages = $messages;
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
        try {
            $this->csrfTokenPresent();
        } catch (Exception $e) {
            $this->errors['root'][] = $e->getMessage();
            return;
        }

        foreach ($this->rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);

            if (!in_array('required', $fieldRules) && !$this->fieldExists($field)) {
                continue;
            }

            $this->validateField($field, $fieldRules);
        }
    }

    private function validateField(string $field, array $fieldRules)
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

            if (!method_exists(FormValidation::class, $fieldRuleName)) {
                trigger_error("❌ The rule you tried to use does not exist: $fieldRuleName");
                continue;
            }

            try {
                $this->{$fieldRuleName}($field, $satisfier);
            } catch (Exception $e) {
                $message = $this->messages["{$field}.{$fieldRuleName}"] ?? $e->getMessage();
                $this->errors[$field][] = $message;

                if ($fieldRuleName === 'required') break;
            }
        }
    }

    private function csrfTokenPresent()
    {
        if (
            !isset($this->formInput['csrfToken']) ||
            Session::get('csrfToken') !== $this->formInput['csrfToken']
        ) {
            throw new Exception("❌ The form request could not be validated. Did you mean to perform this action?");
        }
    }

    private function fieldExists(string $field): bool
    {
        return isset($this->formInput[$field]) && !empty($this->formInput[$field]);
    }

    private function required(string $field)
    {
        if (!$this->fieldExists($field)) {
            throw new Exception("❌ Dieses Feld ist ein Pflichtfeld.");
        }
    }

    private function min(string $field, string $satisfier)
    {
        if (strlen($this->formInput[$field]) < (int) $satisfier) {
            throw new Exception("❌ Das {$field} Feld muss mindestens {$satisfier} Zeichen lang sein.");
        }
    }

    private function max(string $field, string $satisfier)
    {
        if (strlen($this->formInput[$field]) > (int) $satisfier) {
            throw new Exception("❌ Das {$field} Feld darf nicht länger als {$satisfier} Zeichen lang sein.");
        }
    }

    private function email(string $field)
    {
        if (!filter_var($this->formInput[$field], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("❌ Keine valide EMail Adresse.");
        }
    }

    private function matches(string $field, string $satisfier)
    {
        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
            throw new Exception("❌ Das {$field} Feld muss dem {$satisfier} Feld entsprechen.");
        }
    }
}

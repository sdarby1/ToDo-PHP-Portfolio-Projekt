<?php

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
        // Sort required to the front
        usort($fieldRules, function ($firstRule, $secondRule) {
            if ($firstRule === 'required') {
                return -1;
            }

            return 1;
        });

        foreach ($fieldRules as $fieldRule) {
            $ruleSegments = explode(':', $fieldRule);
            $fieldRuleName = $ruleSegments[0];

            // if (isset($ruleSegments[1])) {
            //     $satisfier = $ruleSegments[1];
            // } else {
            //     $satisfier = null;
            // }

            // Ternary operator
            // $satisfier = isset($ruleSegments[1]) ? $ruleSegments[1] : null;

            // Null-coalescing operator
            $satisfier = $ruleSegments[1] ?? null;

            if (!method_exists(FormValidation::class, $fieldRuleName)) {
                trigger_error("The rule you tried to use does not exist: $fieldRuleName");
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

    private function fieldExists(string $field): bool
    {
        return isset($this->formInput[$field]) && !empty($this->formInput[$field]);
    }

    private function required(string $field)
    {
        if (!$this->fieldExists($field)) {
            throw new Exception("❌ Das {$field} Feld ist ein Pflichtfeld.");
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
            throw new Exception("❌ Das {$field} Feld darf nicht länger {$satisfier} Zeichen lang sein.");
        }
    }

    private function email(string $field)
    {
        if (!filter_var($this->formInput[$field], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("❌ Das {$field} Feld muss eine valide Email-Adresse sein.");
        }
    }

    private function matches(string $field, string $satisfier)
    {
        if ($this->formInput[$field] !== $this->formInput[$satisfier]) {
            throw new Exception("❌ Das {$field} muss dem {$satisfier} entsprechen.");
        }
    }
}

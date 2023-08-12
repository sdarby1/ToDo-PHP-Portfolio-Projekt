<?php

class Security {
    public static function csrfToken(): string
    {
        $csrfToken = Str::token();
        Session::set('csrfToken', $csrfToken);

        return $csrfToken;
    }
}
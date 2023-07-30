<?php

function renderErrors(string $inputName) : void {
    global $errors;

    if ( isset( $errors[ $inputName ] ) ) {
		echo "<ul class=\"errors\">";
		foreach ( $errors[ $inputName ] as $error ) {
			echo "<li class=\"error\">$error</li>";
		}
		echo "</ul>";
	}
}
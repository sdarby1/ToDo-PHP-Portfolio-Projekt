<?php
session_start();

// Überprüfen, ob ein Benutzer eingeloggt ist
if (isset($_SESSION['user_id'])) {
    // Sitzung zerstören
    session_unset();
    session_destroy();

    // Bestätigungsnachricht
    $message = "Du hast dich erfolgreich abgemeldet.";

    // Weiterleitung zur Login-Seite mit der Bestätigungsnachricht als URL-Parameter
    header('Location: login-form.php?message=' . urlencode($message));
    exit();
} else {
    // Weiterleitung zur Login-Seite ohne Bestätigungsnachricht
    header('Location: login-form.php');
    exit();
}
?>

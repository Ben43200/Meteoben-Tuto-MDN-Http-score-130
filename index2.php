<?php
// Générer un nonce
$nonce = base64_encode(random_bytes(16)); // Générer un nonce aléatoire

// Configurer la politique de sécurité du contenu (CSP)
header("Content-Security-Policy: default-src 'none'; script-src 'self' 'nonce-$nonce' https://cdnjs.cloudflare.com; style-src 'self' 'nonce-$nonce' https://cdnjs.cloudflare.com; img-src 'self'; font-src 'self'; connect-src 'self'; frame-src 'none'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none';");

// Configurer Strict-Transport-Security (HSTS)
header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");

// Configurer X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

// Configurer X-Frame-Options
header("X-Frame-Options: DENY");

// Configurer X-XSS-Protection
header("X-XSS-Protection: 1; mode=block");

// Configurer Referrer-Policy
header("Referrer-Policy: no-referrer-when-downgrade");

// Configurer Feature-Policy
header("Permissions-Policy: geolocation=(), midi=(), notifications=(), push=(), sync-xhr=(), microphone=(), camera=(), magnetometer=(), gyroscope=(), speaker=(), vibrate=(), fullscreen=(), payment=()");

// Configurer les cookies sécurisés
$cookieParams = session_get_cookie_params();
session_set_cookie_params([
    'lifetime' => $cookieParams['lifetime'], // Utiliser la durée de vie par défaut
    'path' => $cookieParams['path'], // Utiliser le chemin par défaut
    'domain' => $cookieParams['domain'], // Utiliser le domaine par défaut
    'secure' => true, // Assurez-vous que le cookie est transmis uniquement via HTTPS
    'httponly' => true, // Empêche l'accès au cookie via JavaScript
    'samesite' => 'Strict' // Empêche l'envoi du cookie avec des requêtes cross-site
]);
session_name('__Secure-PHPSESSID'); // Changer le nom de session pour inclure le préfixe sécuritaire
session_start(); // Démarrer la session
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP security</title>
    <meta name="description" content="Implementer sécurité php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha384-/rJKQnzOkEo+daG0jMjU1IwwY9unxt1NBw3Ef2fmOJ3PW/TfAg2KXVoWwMZQZtw9" crossorigin="anonymous">
</head>

<body>
<main>
<div data-aos="fade-up-left" data-aos-duration="1500">
                    <span> Test </span>
                </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha384-n1AULnKdMJlK1oQCLNDL9qZsDgXtH6jRYFCpBtWFc+a9Yve0KSoMn575rk755NJZ" crossorigin="anonymous" nonce="<?php echo $nonce; ?>"></script>
<script nonce="<?php echo $nonce; ?>">
        // Initialiser AOS
        AOS.init();
    </script>
</body>
</html>
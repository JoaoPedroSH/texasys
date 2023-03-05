<?php

require_once('Environment.php');

use config\Environment;

Environment::load();

echo <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
        <title> Variáveis de Ambiente </title>
        </head>
        <body>
            <div>
                <h1>{$_ENV['ENVIRONMENT']}</h1>
                <h3>MYSQL</h3>
                <p>Host: <strong>{$_ENV['HOST']}</strong></p>
                <p>User: <strong>{$_ENV['USER']}</strong></p>
                <p>Password: <strong>{$_ENV['PASSWORD']}</strong></p>
                <p>Database: <strong>{$_ENV['DATABASE']}</strong></p>
            </div>
        </body>
    </html>
HTML;
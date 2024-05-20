 <?php

function docker_secret(string $secret_file): string
{
    echo(trim(file_get_contents($secret_file)));
    return trim(file_get_contents($secret_file));
}

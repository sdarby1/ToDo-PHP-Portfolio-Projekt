<?php

function convertToUnixPath(string $path): string {
    return str_replace([DIRECTORY_SEPARATOR, '\\'], '/', $path);
}

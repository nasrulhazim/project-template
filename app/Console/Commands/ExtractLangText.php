<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ExtractLangText extends Command
{
    // Define the command signature to accept a locale argument and an optional path
    protected $signature = 'lang:extract {locale} {path?}';

    protected $description = 'Extract all text within the __() helper and output to the /lang/{locale}.json file or a custom path';

    // Execute the command
    public function handle()
    {
        // Get the locale and optional output path from the command arguments
        $locale = $this->argument('locale');
        $path = $this->argument('path') ?: base_path('lang'); // Default to base_path('/lang') if no path is provided

        // Ensure the directory exists
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $outputFile = $path."/$locale.json";

        if (file_exists($outputFile) && ! $this->confirm("$outputFile already exists. Are you sure want to overwrite it?")) {
            return;
        } else {
            unlink($outputFile);
            $this->components->info("$outputFile removed.");
        }

        // Find all files in app, routes, and resources/views directories
        $directories = [
            base_path('app'),
            base_path('routes'),
            base_path('resources/views'),
        ];

        $translations = [];

        foreach ($directories as $directory) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
            foreach ($files as $file) {
                if ($file->isFile() && in_array($file->getExtension(), ['php', 'blade.php'])) {
                    $content = file_get_contents($file->getPathname());

                    // Regex to find all instances of __()
                    preg_match_all("/__\(\s*[\'\"](.*?)[\'\"]\s*\)/", $content, $matches);

                    // Store the results
                    foreach ($matches[1] as $key) {
                        if (! isset($translations[$key])) {
                            $translations[$key] = $key;  // Initial extraction without translation
                        }
                    }
                }
            }
        }

        ksort($translations);

        // Write translations to a JSON file in the target directory
        file_put_contents($outputFile, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        $this->components->info("Translations extracted successfully and saved to $outputFile");
    }
}

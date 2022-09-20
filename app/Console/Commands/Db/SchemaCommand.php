<?php

namespace App\Console\Commands\Db;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SchemaCommand extends Command
{
    public $database_connection;

    public $format;

    public $connection;

    public $schema;

    public $tables;

    public $collections = [];

    /**
     * Output Path.
     *
     * @var string
     */
    public $output_path;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:schema {--database=} {--format=md} {--path=} {--emoji}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate database schema to markdown (by default)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
         * Initialize
         */
        $this->init();

        /*
         * Generate Table & Column Data Structure
         */
        $this->generateDataStructure();

        /*
         * Generate Document
         */
        $this->generateDocument();
    }

    private function init()
    {
        $this->output_path = $this->option('path') ?? config('database.doc_schema_path');

        if (! file_exists($this->output_path)) {
            mkdir($this->output_path);
        }

        $this->database_connection = $this->option('database') ?? config('database.default');
        $this->format = $this->option('format');
        $this->connection = DB::connection($this->database_connection)->getDoctrineConnection();
        $this->schema = $this->connection->getSchemaManager();
        $this->tables = $this->schema->listTableNames();
    }

    private function generateDataStructure()
    {
        $tables = $this->tables;
        $schema = $this->schema;

        $this->collections = [];
        foreach ($tables as $table) {
            $columns = $schema->listTableColumns($table);
            $foreignKeys = collect($schema->listTableForeignKeys($table))->keyBy(function ($foreignColumn) {
                return $foreignColumn->getLocalColumns()[0];
            });
            $this->info('Table: '.$table);
            foreach ($columns as $column) {
                $columnName = $column->getName();
                $columnType = $column->getType()->getName();
                if (isset($foreignKeys[$columnName])) {
                    $foreignColumn = $foreignKeys[$columnName];
                    $foreignTable = $foreignColumn->getForeignTableName();
                    $columnType = 'FK -> '.$foreignTable;
                }
                $length = $column->getLength();

                $details['column'] = $columnName;
                $details['type'] = $columnType.$this->determineUnsigned($column);
                $details['length'] = $length != 0 ? $length : null;
                $details['default'] = $this->getDefaultValue($column);
                $details['nullable'] = $this->getExpression(true === ! $column->getNotNull());
                $details['comment'] = $column->getComment();
                $this->collections[$table][] = $details;
            }
        }
    }

    private function generateDocument()
    {
        switch ($this->format) {
            case 'json':
                $rendered = $this->render_json_content();

                break;

            default:
                $rendered = $this->render_markdown_content();

                break;
        }
        $filename = $rendered['filename'];
        $output = $rendered['output'];
        $path = $this->output_path.DIRECTORY_SEPARATOR.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        file_put_contents($path, $output);
    }

    private function getStub()
    {
        return file_get_contents(base_path('stubs/db/doc.schema.stub'));
    }

    private function determineUnsigned($column)
    {
        return (true === $column->getUnsigned()) ? '(unsigned)' : '';
    }

    private function getDefaultValue($column)
    {
        if ('boolean' == $column->getType()->getName()) {
            return $column->getDefault() ? 'true' : 'false';
        }

        return $column->getDefault();
    }

    private function getExpression($status)
    {
        if ($this->option('emoji')) {
            return $status ? "\u{2705}" : "\u{274C}";
        }

        return $status ? 'Yes' : 'No';
    }

    private function render_json_content()
    {
        $collections = $this->collections;

        return [
            'output' => json_encode($collections),
            'filename' => config('app.name').' Database Schema.json',
        ];
    }

    private function render_markdown_content()
    {
        $collections = $this->collections;
        $output = [];
        foreach ($collections as $table => $properties) {
            $table = preg_replace('/[^A-Za-z0-9]/', ' ', $table);
            $output[] = '### '.Str::title($table).PHP_EOL.PHP_EOL;
            $output[] = '| Column | Type | Length | Default | Nullable | Comment |'.PHP_EOL;
            $output[] = '|--------|------|--------|---------|----------|---------|'.PHP_EOL;
            foreach ($properties as $key => $value) {
                $fields = [];
                foreach ($value as $k => $v) {
                    $fields[] = "{$v}";
                }
                $output[] = '| '.implode(' | ', $fields).' |'.PHP_EOL;
            }
            $output[] = PHP_EOL;
        }

        $schema = implode('', $output);
        $stub = $this->getStub();
        $database_config = config('database.connections.'.$this->database_connection);
        $host = isset($database_config['host']) ? $database_config['host'] : null;
        $port = isset($database_config['port']) ? $database_config['port'] : null;
        $output = str_replace([
            'APP_NAME',
            'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE',
            'SCHEMA_CONTENT',
        ], [
            config('app.name'),
            $this->database_connection, $host, $port, $database_config['database'],
            $schema,
        ], $stub);

        $filename = config('app.name').' Database Schema.md';

        return [
            'output' => $output,
            'filename' => $filename,
        ];
    }
}

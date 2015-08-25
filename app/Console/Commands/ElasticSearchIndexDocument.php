<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use App\Providers\ElasticSearch;

class ElasticSearchIndexDocument extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:ingest-documents {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest json documents to Elastic Search for indexing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path');
        if(!file_exists($path)) {
            $path = env('XSLT_OUT_PATH');
        }

        $errors = array();
        $files = array_diff(scandir($path), array('..', '.'));
        foreach($files as $file) {
            $text = file_get_contents($path.$file);
            $body = json_decode($text, true);

            $id = $body['id'];
            $index = env('ES_STUDY_UNIT_INDEX');
            $type = env('ES_STUDY_INDEX_TYPE');

            $this->comment('Importing: '.$path.$file);
            $result = ElasticSearch::indexDocument($id, $index, $type, $body);

            if(!$result['created']) {
                array_push($errors, $path.$file);
            }
        }

        $this->info(PHP_EOL.'Result: ');
        $this->info('File to ingest: '.sizeof($files));
        $this->info('Failed: '.sizeof($errors));
        $this->comment(PHP_EOL.'Error files:');
        foreach($errors as $error) {
            $this->comment('File: '.$error);
        }
    }
}

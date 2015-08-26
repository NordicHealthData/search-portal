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
    protected $signature = 'es:ingest-documents {path=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest json documents to Elasticsearch for indexing';

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
        if(!isset($path) || !file_exists($path)) {
            $path = env('XSLT_OUT_PATH');
        }
        $this->info(PHP_EOL.'Using directory path for ingest: '.$path.PHP_EOL);

        $errors = array();
        $files = array_diff(scandir($path), array('..', '.'));
        foreach($files as $file) {
            $text = file_get_contents($path.$file);
            $body = json_decode($text, true);
            if(!isset($body)) { // not conform json!
                array_push($errors, $path.$file.' - JSON error');
                continue;
            }

            $id = $body['id'];
            $index = env('ES_STUDY_UNIT_INDEX');
            $type = env('ES_STUDY_INDEX_TYPE');

            $this->comment('Importing: '.$path.$file);
            $result = ElasticSearch::indexDocument($id, $index, $type, $body);

            if(!isset($result)) { // not conform json!
                array_push($errors, $path.$file.' - ES ingest error');
                continue;
            }
            \Log::debug(json_encode($result));

            if($result['created']) {
                $this->comment(' - result: Created');
            }
            if(intval($result['_version'])>1) {
                $this->comment(' - result: Updated to version: '.$result['_version']);
            }
        }

        $this->info(PHP_EOL.'Result: ');
        $this->info('Files to ingest: '.sizeof($files));
        $this->info('Failed: '.sizeof($errors));
        $this->comment(PHP_EOL.'Error files:');
        foreach($errors as $error) {
            $this->comment('File: '.$error);
        }
    }
}

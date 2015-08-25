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
    protected $signature = 'es:index-document {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post json document to Elastic Search for indexing';

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

        if(file_exists($path)){
            $text = file_get_contents($path);
            $body = json_decode($text, true);

            $id = $body['id'];
            $index = Config::get("app.elastic_search_index");
            $type = $body['kindofdata'];

            $this->comment(PHP_EOL.'importing '.$path.PHP_EOL);
            ElasticSearch::indexDocument($id, $index, $type, $body);
        }else{
            $this->comment(PHP_EOL.$path.' does not exist'.PHP_EOL);
        }
    }
}

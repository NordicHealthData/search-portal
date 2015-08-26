<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Providers\ElasticSearch;

class ElasticSearchDeleteIndex extends Command {
    
    protected $signature = 'es:delete-index {index=null}';
    protected $description = 'Deletes a elastic search index. Option: index';

    /**
     * Deletes the index specified
     * @return mixed
     */
    public function handle() {
        $index = $this->argument('index');
        $this->info(PHP_EOL.'Using index: '.$index.PHP_EOL);

        if(isset($index)){
            $result = ElasticSearch::deleteIndex($index);
            $this->comment($result);
        }else{
            $this->comment('No index given');
        }
    }
}

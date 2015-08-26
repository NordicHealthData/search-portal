<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class ElasticSearchDeleteIndex extends Command {
    
    protected $signature = 'es:delete-index {index}';
    protected $description = 'Deletes a elastic search index';

    /**
     * Deletes the index specified
     * @return mixed
     */
    public function handle() {
        $index = $this->argument('index');
        if(isset($index)){
            $result = ElasticSearch::deleteIndex($index);
            $this->comment($result);
        }else{
            $this->comment('No index given');
        }
    }
}

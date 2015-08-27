<?php

namespace app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Helpers\XsltHelper;

class DdiXsltTransform extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xslt:ddi-to-json {version=ddi31} {path=null} {outpath=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transform DDI to JSON. Options: [ddi122|ddi31] path outpath';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path');
        if(!isset($path) || !file_exists($path)) {
            $path = env('XSLT_IN_PATH');
        }
        if (strcmp(substr($path, -1), '/') !== 0) {
            $path .= '/';
        }
        $this->info(PHP_EOL.'Using directory path for transformation: '.$path);

        $outpath = $this->argument('outpath');
        if(!isset($outpath) || !file_exists($outpath)) {
            $outpath = env('XSLT_OUT_PATH');
        }
        $this->info('Using directory output path: '.$outpath);

        $ddiVersion = $this->argument('version');
        $this->info('Using DDI version: '.$ddiVersion.PHP_EOL);

        if($ddiVersion=='ddi31') {
            $xslt = XsltHelper::DDI3_1_TO_JSON;
        } elseif($ddiVersion=='ddi122') {
            $xslt = XsltHelper::DDI1_2_2_TO_JSON;
        } else {
            $this->error('Exiting: DDI version not defined!');
            return;
        }

        $files = array_diff(scandir($path), array('..', '.'));
        $helper = new XsltHelper();
        foreach($files as $file) {
            if(file_exists($path.$file)) {
                $this->comment('Transforming: ' . $path . $file);
                $helper->transform($xslt, $path . $file, $outpath);
            }
        }

        $this->info(PHP_EOL.'Result: ');
        $this->info('Files to transform: '.sizeof($files));
        $this->info('Files transformed: '.sizeof(array_diff(scandir($outpath)
            , array('..', '.'))));
    }
}

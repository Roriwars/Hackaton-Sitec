<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class NewCve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:cve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appelle a l\'api pour ajouter de nouvelles cves';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
    }
}

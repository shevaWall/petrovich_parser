<?php

namespace App\Console\Commands;

use App\Service\ParserService;
use Illuminate\Console\Command;

class ParseShopItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:shopItems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'parse product cards from Petrovich website';

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
        $parser = new ParserService();
        $parser->getShopItems();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Goutte\Client;
use App\GoldPrice;
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      
        $client = new Client();
        //  $page = $client->request('GET', 'https://www.xe.com/currencytables/?from=XAU&date=2020-12-29');
        $page = $client->request('GET', 'http://goldpricez.com/eg/gram');

        $total = $page->filter('.display_rates')->text();
        $percentage = .2;
        $coldeprice = substr($total, 27);
        $new_total = ($percentage / 100) * $coldeprice;
        $last_total = $coldeprice + $new_total;

        $client = new Client();
        ////////us
        $page_us = $client->request('GET', 'http://goldpricez.com/us/gram');
        $total_us = $page_us->filter('.display_rates')->text();
        $coldeprice_us = substr($total_us, 29);
        $percentage = .2;
        $new_total_us = ($percentage / 100) * $coldeprice_us;
        $last_total_us = $coldeprice_us + $new_total_us;

        $data['price_us']= $last_total_us;
        $data['price_eg']= $last_total;
       
        GoldPrice::create($data);

        $this->info('Demo:Cron Cummand Run successfully!');
    }
}

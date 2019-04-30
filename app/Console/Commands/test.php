<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command {argument}';

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
     * @return mixed
     */
    public function handle()
    {
        $value = $this->argument('argument');
        $reslut = str_split($value);
        $Direction = ['North','East','South','West'];
        $x = 0;
        $y = 0;
        $SDirection = 0;
        $count = 0;
        preg_match_all('!\d+!', $value, $matches);
        foreach($reslut as $row){
            if($row == 'R'){
                if($SDirection == 3){
                    $SDirection = 0;
                }else{
                    $SDirection++;
                }
            }else if($row == 'L'){
                if($SDirection == 0){
                    $SDirection = 3;
                }else{
                    $SDirection--;
                }
            }else if($row == 'W'){
                if($SDirection == 0){
                    $y+=$matches[0][$count];
                }else if($SDirection == 1){
                    $x+=$matches[0][$count];
                }else if($SDirection == 2){
                    $y-=$matches[0][$count];
                }else if($SDirection == 3){
                    $x-=$matches[0][$count];
                }
                $count++;
            }
        }
        $this->info('Result = X:'.$x.' Y:'.$y.' Direction:'.$Direction[$SDirection]);
    }
}

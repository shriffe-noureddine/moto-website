<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestControllerAPI extends Controller
{
    private $namePattern = '/(?!.*\/).+/';
    private $brandPattern = '/(!?.+)-/';
    private $noPublicPattern = '/(!?\/public)(.+)/';
    private $colors = ['black', 'red', 'white', 'grey', 'blue'];

    private function randomDate($earliestYear, $latestYear, $controlFlag)
    {        
        if ($controlFlag == 1){
            return strval(rand($earliestYear, $latestYear));
        }else {
            return strval(rand($earliestYear, $latestYear)) . "-" . strval(rand(01, 12)) . "-" . strval(rand(1, 28));
        }
    }
    
    private function randLetter()
    {
        $int = rand(0, 51);
        $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_letter = $a_z[$int];
        return $rand_letter;
    }

    private function createSeed($name, $picPath, $thumbnailPath)
    {

        $constructionDate = $this->randomDate(1890, 2010, 1);
        preg_match($this->brandPattern, $name, $match);
        $brand = $match[1];

        $model = $this->randLetter().$this->randLetter().$this->randLetter().$this->randLetter().strval(rand(2,99));

        $color = $this->colors[rand(0,count($this->colors)-1)];

        $price = 0;
        if (rand(1,6) == 1){
            $price = rand(12, 1000)*1000;
        }
        $price = strval($price);

        $user_id = strval(rand(1,9));

        $description = addslashes(json_decode($this->chuckNorrisAPI())->value);

        $picture = $picPath;
        $thumbnail = $thumbnailPath;

        $created_at = $this->randomDate(2017, 2019, 2);

        $outstring = "
        DB::table('motors')->insert([
            'constructionDate' => '".$constructionDate."',
            'brand' => '".$brand."',
            'model' => '".$model."',
            'color' => '".$color."',
            'price' => '".$price."',
            'user_id' => '".$user_id."',
            'description' => '".$description."',
            'picture' => '".$picture."',
            'thumbnail' => '".$thumbnail."',
            'created_at' => '".$created_at."',
        ]);
        ";
        //echo $outstring;
        //echo "<hr>";
        return $outstring;

    }

    private function wrapSeedFile($x, $file){
        $header = "<?php
        use Illuminate\Database\Seeder;
        class MotorsTableSeeder extends Seeder
        {
            /*
            * Run the database seeds.
            ** @return void
            */
            public function run()
            {
        ";

        $footer = "
        }
    }
    ";

        if($x == 1){
            file_put_contents($file, $header, LOCK_EX);
        } else {
            file_put_contents($file, $footer, FILE_APPEND | LOCK_EX);
        }
    }

    private function storeMotoPics($motos)
    {
        set_time_limit(60 * 30); // seconds that a script is allowed to run, default is 60
        $systemPath = 'C:\\1-melting-pot\\scripts\\201912-fit4coding-finalproject\\finalProject2\\laravel';
        $basePath = '/public/pics/motos/';
        $codePath = '/pics/motos/';
        $seedFilePath = $systemPath . '/database/seeds/MotorsTableSeeder.php';
        $this->wrapSeedFile(1, $seedFilePath);
        // 132 pics, will take about 10 minuts to download
        foreach ($motos as $name => $moto) {
            //echo $name;
            //echo '<br>';
            //var_dump($moto);
            //echo '<hr>';
            $picPath = $codePath.$name; 
            $thumbnailPath = $codePath."zz-".$name;                
            //file_put_contents($systemPath.$picPath, fopen($moto['pic'], 'r'));
            //file_put_contents($systemPath.$thumbnailPath, fopen($moto['thumbnail'], 'r'));
            $string2file = $this->createSeed($name, $picPath, $thumbnailPath);
            file_put_contents($seedFilePath, $string2file, FILE_APPEND | LOCK_EX);
        }
        $this->wrapSeedFile(2, $seedFilePath);
    }

    public function pixabayDownloader()
    {
        $response_string = $this->testPixabayAPI();
        $json = json_decode($response_string);
        //echo $json->totalHits;
        $count = 0;
        $motos = array();
        $moto = array();
        foreach ($json->hits as $hit) {
            //echo $hit->previewURL;
            //echo '<br>';
            $count++;
            $moto["thumbnail"] = $hit->previewURL;
            $moto["pic"] = $hit->largeImageURL;
            preg_match($this->namePattern, $moto["thumbnail"], $match);
            //var_dump($match);
            $motos[$match[0]] = $moto;
        }
        //echo $count;
        //echo '<br>';
        //var_dump($motos);
        $this->storeMotoPics($motos);
    }


   

    public function currentDateTime()
    {
        $URL =  'http://worldtimeapi.org/api/timezone/Europe/Paris';
        return view('testpages.datetime', ['response' => $this->curl4API($URL)]);
    }
    
    public function chuckNorrisAPI()
    {
        $URL =  'https://api.chucknorris.io/jokes/random';
        return $this->curl4API($URL);
    }
    
    public function testfreeforexAPI()
    {
        $URL = 'https://www.freeforexapi.com/api/live?pairs=EURGBP,USDJPY';
        return $this->curl4API($URL);
    }

    public function testPixabayAPI()
    {
        //$URL = 'https://pixabay.com/api/?key=2288322-de7c9302df7375fc562c8d30c&q=motorcycle+oldtimer';
        $URL = 'https://pixabay.com/api/?key=2288322-de7c9302df7375fc562c8d30c&q=motorcycle+oldtimer&per_page=200';
        return $this->curl4API($URL);
    }

    public function testScryfallAPI()
    {
        $URL = 'https://api.scryfall.com/cards/search?q=t%3Amerfolk+t%3Agoblin';
        return $this->curl4API($URL);
    }

    public function curl4API($URL)
    {
        $curl = curl_init();

        $opts = [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        curl_close($curl);


        return $response;
    }
}

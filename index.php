<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
function format ($expre) {
    echo "<pre>";
    print_r($expre);
    echo "</pre>";
  }

function request ($url) {
  $ch = curl_init();
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $output = curl_exec($ch);
  $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // получение кода состояния HTTP
return $output;
}



 $servername = "localhost";
  $username = "user";
  $password = "user";
  $dbname = "parser_strum";
  
  // Создание соединения
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Проверка соединения
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";



  // $url = 'https://strument.com.ua/category/zapchasti-al-ko/';
  // $ch = curl_init();
  
  // curl_setopt($ch, CURLOPT_URL, $url);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
  // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  // $output = curl_exec($ch);
  // $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // получение кода состояния HTTP

  require 'phpquery.php';
//   $document = phpQuery::newDocument($output);
//   $pagination_links = pq('a.no_underline');
//   foreach ($pagination_links as $key=>$link) {
//     $pq1 =pq($link)->text();
//     $last_page[$key] = $pq1;
//   }

// $trash_page = array_pop($last_page);
// $last_page_url = end($last_page);
//   for ($n = $last_page_url; $n > 0; $n--) {
//           $full_url = 'https://strument.com.ua/category/zapchasti-al-ko/' . 'page' . $n;
//           $sql = "INSERT INTO pagination_links (id, pagin_links) VALUES (NULL, '$full_url')";
//             if ($conn->query($sql) === TRUE) {
//               echo "New record created successfully";
//           } else {
//               echo "Error: " . $sql . "<br>" . $conn->error;
//           }   
//       }




  $sql = "SELECT * FROM pagination_links";
$result = $conn->query($sql);

  
  while ($row = $result->fetch_assoc()){
    $row_cnt = $result->num_rows;
   echo $row_cnt.'<br>';

$page_links_pagin = ($row['pagin_links']);
echo $page_links_pagin;
$responce = request($page_links_pagin);
$document = phpQuery::newDocument($responce);
$all_links_product = pq('.product_brief_table')->find('a.pb_product_name');
foreach ($all_links_product as $links) {
  $pqlinks_product = pq($links)->attr('href');
  $full_links_product = 'https://strument.com.ua' . $pqlinks_product;
  // echo $full_links_product.'<br>';
  // $full_links_product_array[] = $full_links_product;

//   $sql_product = "INSERT INTO products (id, product_links) VALUES (NULL, '$full_links_product')";
//             if ($conn->query($sql_product) === TRUE) {
//               echo "New record created successfully";
//           } else {
//               echo "Error: " . $sql_product . "<br>" . $conn->error;
//           }   
      }
  // foreach ($full_links_product_array as $link_item) {
  //   echo $link_item.'<br>';

  // }
  

//       $document->unloadDocument();

if ($row_cnt == 8) {
  break;
  }

}


// $sql = "SELECT * FROM products";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()){
//     $product_link = ($row['product_links']);
// $request_product = request($product_link);   
// $document = phpQuery::newDocument($request_product);

// $sku = pq('.product_code')->text();
// $pattern = "/для заказа: (.*) \/ Артикул/";
// $preg = preg_match($pattern, $sku, $matches);
// $sku = $matches[1];



//  $picture = pq('#img-current_picture')->attr('data-src');
//  $pattern_picture = "/data:image\/png/";
//  $preg_picture = preg_match($pattern_picture, $picture, $matches);
//  echo $preg_picture. '<br>';
//  if ($preg_picture==1) continue;



// $picture = 'https://strument.com.ua'. $picture; 
// $sql_picture = "INSERT INTO picture (id, href, product_id) VALUES (NULL, '$picture', '$sku')";
// $conn->query($sql_picture); 



// }

//   }






  
  




















  
  




// namespace Facebook\WebDriver;

// use Facebook\WebDriver\Remote\DesiredCapabilities;
// use Facebook\WebDriver\Remote\RemoteWebDriver;

// require_once('vendor/autoload.php');

// // This is where Selenium server 2/3 listens by default. For Selenium 4, Chromedriver or Geckodriver, use http://localhost:4444/
// $host = 'http://localhost:9515';

// $capabilities = DesiredCapabilities::chrome();

// $driver = RemoteWebDriver::create($host, $capabilities);

// // navigate to Selenium page on Wikipedia
// $driver->get('https://www.kramp.com/shop-ua/uk');




// $button = $driver->findElement(WebDriverBy::cssSelector('.primary'));
// $button->click();

// $enter_log = $driver->findElement(WebDriverBy::xpath('//*[@id="__next"]/header/div[1]/div/div/div[3]/div/div[3]/div/a/span'));

// $enter_log->click();
// $login = $driver->findElement(WebDriverBy::name('username'));
// $login->sendKeys('strumentua@gmail.com');
// $password = $driver->findElement(WebDriverBy::name('password'));
// $password->sendKeys('strument1')->submit();
// sleep(3);
// $firstmenuglobal = $driver->findElement(WebDriverBy::xpath('/html/body/div[2]/header/div[2]/div/div/div[1]/div/nav/a[1]'));
// $firstmenuglobal->click();
// $html = $driver->getPageSource();
// file_put_contents('/Users/albertas/pages/page.html', $html);


// require 'phpquery.php';
// $html = file_get_contents('/Users/albertas/pages/page.html');
// $document = phpQuery::newDocument($html);
// $product_table = pq('.kh-sz4e9')->find('a');
// foreach ($product_table as $product) {
// $pq = pq($product)->attr('href');
// echo urldecode($pq).'<br>';
// }










// $text_all = [];
// $links_all = [];
// $links = $document->find('.kh-w3piuq');
// $text = $document->find('span.kh-m2feck');
// foreach ($links as $key => $link) {
//    $pqlink = pq($link)->attr('href');
//    $pqlink = urldecode($pqlink);

//    $full_links = 'https://www.kramp.com'. $pqlink.'<br>';
//    $sql = "INSERT INTO links (id, link, name)
// VALUES (NULL, '$full_links', 'name')";
//   if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
  
//    $links_all[$key]['link'] = $full_links;
   
//    foreach ($text as $key => $tex) {
//       $pqtext = pq($tex)->text();
//       $links_all[$key]['text'] = $pqtext;
      
//    }
// }
// format($links_all);







// $input = $driver->findElement(WebDriverBy::tagName('input'));


// $input->sendKeys("AL-KO")->submit();
// $driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');






// $array_str = [];
// $filename = '/Users/albertas/lbrake_links.txt';
// $lines = file($filename, FILE_IGNORE_NEW_LINES);
// foreach ($lines as $line) {
//   $str = "'".$line."'";
//   $array_str[] = $str; 
// }
// $string = implode(", ", $array_str);
// $string = strtoupper($string);
// echo $string;
//
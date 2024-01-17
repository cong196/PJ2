<?php

    use Automattic\WooCommerce\Client;

    require __DIR__ . '/vendor/autoload.php';

    include "dbConnect.php";
    include "config.php";

    $site = json_decode(getKey(''), true); // Add true to decode as associative array

    $woocommerce = new Client(
        $site['url'],
        $site['ck'],
        $site['cs'],
        [
            'version' => 'wc/v3',
        ]
    );

    /*$page = 1;
$data = ['create' => []];

do {
    $params = [
        'per_page' => 100,
        'page' => $page,
    ];

    $categories = $woocommerce->get('products/categories', $params);

    if (!empty($categories)) {
        $categoryData = array_map(function ($category) {
            return [
                'name'   => $category->name,
                // Add more fields as needed
            ];
        }, $categories);

        $data['create'][] = $categoryData;

        $page++;
    }

} while (!empty($categories));

// Convert $data to JSON
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// Output the JSON string
echo $jsonData;*/

$data = [
  "create" => [
    
    [
        "name"=> "4th Of July"
      ],
      [
        "name"=> "Aaron Judge"
      ],
      [
        "name"=> "Accessories"
      ],
      [
        "name"=> "Alabama Crimson Tide"
      ],
      [
        "name"=> "All Over Print"
      ],
      [
        "name"=> "Anaheim Ducks"
      ],
      [
        "name"=> "Animal Lovers"
      ],
      [
        "name"=> "Anime"
      ],
      [
        "name"=> "Anniversary Gift For Husband"
      ],
      [
        "name"=> "Anniversary Gift For Wife"
      ],
      [
        "name"=> "Anniversary Gifts"
      ],
      [
        "name"=> "Apparel"
      ],
      [
        "name"=> "Arizona Cardinals"
      ],
      [
        "name"=> "Arizona Coyotes"
      ],
      [
        "name"=> "Arizona Diamondbacks"
      ],
      [
        "name"=> "Atlanta Falcons"
      ],
      [
        "name"=> "Attack On Titan"
      ],
      [
        "name"=> "Auburn Tigers"
      ],
      [
        "name"=> "Baby yoda"
      ],
      [
        "name"=> "Baltimore Ravens"
      ],
      [
        "name"=> "Beach Short"
      ],
      [
        "name"=> "Beer"
      ],
      [
        "name"=> "Birthday Gifts"
      ],
      [
        "name"=> "Birthday Gifts For Dad"
      ],
      [
        "name"=> "Birthday Gifts For Daughter"
      ],
      [
        "name"=> "Birthday Gifts For Her"
      ],
      [
        "name"=> "Birthday Gifts For Him"
      ],
      [
        "name"=> "Birthday Gifts For Husband"
      ],
      [
        "name"=> "Birthday Gifts For Mom"
      ],
      [
        "name"=> "Birthday Gifts For Son"
      ],
      [
        "name"=> "Birthday Gifts For Wife"
      ],
      [
        "name"=> "Black Clover"
      ],
      [
        "name"=> "blanket"
      ],
      [
        "name"=> "Boston Bruins"
      ],
      [
        "name"=> "Boston Red Sox"
      ],
      [
        "name"=> "Brooklyn Nets"
      ],
      [
        "name"=> "Bud Light Beer"
      ],
      [
        "name"=> "Buffalo Bills"
      ],
      [
        "name"=> "Buffalo Sabres"
      ],
      [
        "name"=> "Cale Makar"
      ],
      [
        "name"=> "Calgary Flames"
      ],
      [
        "name"=> "Camping Gifts"
      ],
      [
        "name"=> "canvas"
      ],
      [
        "name"=> "canvas High Top"
      ],
      [
        "name"=> "Captain America"
      ],
      [
        "name"=> "Captain Morgan Gifts"
      ],
      [
        "name"=> "Carolina Hurricanes"
      ],
      [
        "name"=> "Carolina Panthers"
      ],
      [
        "name"=> "Cat Lovers Gifts"
      ],
      [
        "name"=> "Chicago Bears"
      ],
      [
        "name"=> "Chicago BlackHawks"
      ],
      [
        "name"=> "Chicago Bulls"
      ],
      [
        "name"=> "Chicago Cubs"
      ],
      [
        "name"=> "Christmas"
      ],
      [
        "name"=> "Christmas Gifts For Dad"
      ],
      [
        "name"=> "Christmas Gifts For Daughter"
      ],
      [
        "name"=> "Christmas Gifts For Husband"
      ],
      [
        "name"=> "Christmas Gifts For Mom"
      ],
      [
        "name"=> "Christmas Gifts For Son"
      ],
      [
        "name"=> "Christmas Gifts For Wife"
      ],
      [
        "name"=> "Cincinnati Bengals"
      ],
      [
        "name"=> "Cincinnati Reds"
      ],
      [
        "name"=> "Clemson Tigers"
      ],
      [
        "name"=> "Cleveland Browns"
      ],
      [
        "name"=> "Cleveland Guardians"
      ],
      [
        "name"=> "Colorado Avalanche"
      ],
      [
        "name"=> "Columbus Blue Jackets"
      ],
      [
        "name"=> "Combo Hawaiian Beach"
      ],
      [
        "name"=> "Connor McDavid"
      ],
      [
        "name"=> "Crown Royal Gifts"
      ],
      [
        "name"=> "custom Blanket"
      ],
      [
        "name"=> "Dallas Cowboys"
      ],
      [
        "name"=> "Dallas Stars"
      ],
      [
        "name"=> "dark Color Shirts"
      ],
      [
        "name"=> "Darth Vader"
      ],
      [
        "name"=> "DC"
      ],
      [
        "name"=> "Death Note"
      ],
      [
        "name"=> "Demon Slayer"
      ],
      [
        "name"=> "Denver Broncos"
      ],
      [
        "name"=> "Detroit Lions"
      ],
      [
        "name"=> "Detroit Red Wings"
      ],
      [
        "name"=> "Detroit Tigers"
      ],
      [
        "name"=> "Disney"
      ],
      [
        "name"=> "Dog Lovers Gifts"
      ],
      [
        "name"=> "Dog Mom Gifts"
      ],
      [
        "name"=> "Donald duck"
      ],
      [
        "name"=> "Dragon Ball"
      ],
      [
        "name"=> "Drinks"
      ],
      [
        "name"=> "Easter"
      ],
      [
        "name"=> "Edmonton Oilers"
      ],
      [
        "name"=> "Eren Yeager"
      ],
      [
        "name"=> "Family Gifts"
      ],
      [
        "name"=> "Farmer"
      ],
      [
        "name"=> "Father's Day"
      ],
      [
        "name"=> "Firefighter"
      ],
      [
        "name"=> "Flag"
      ],
      [
        "name"=> "Florida Gators"
      ],
      [
        "name"=> "Florida Panthers"
      ],
      [
        "name"=> "Georgia Bulldogs"
      ],
      [
        "name"=> "Gift for Dad"
      ]
    ]
]
;
print_r($woocommerce->post('products/categories/batch', $data));
$data2 = [
  "create" => [
    [
        "name"=> "Gift for Daughter"
      ],
      [
        "name"=> "Gift for Husband"
      ],
      [
        "name"=> "Gift for Mom"
      ],
      [
        "name"=> "Gift for Son"
      ],
      [
        "name"=> "Gift for Wife"
      ],
      [
        "name"=> "Golden State Warriors"
      ],
      [
        "name"=> "Green Bay Packers"
      ],
      [
        "name"=> "Grinch Sweater"
      ],
      [
        "name"=> "Halloween"
      ],
      [
        "name"=> "Harry Potter"
      ],
      [
        "name"=> "hats"
      ],
      [
        "name"=> "Hiking"
      ],
      [
        "name"=> "Historia Reiss"
      ],
      [
        "name"=> "Home & Living"
      ],
      [
        "name"=> "Houston Astros"
      ],
      [
        "name"=> "Houston Texans"
      ],
      [
        "name"=> "Hunter x Hunter"
      ],
      [
        "name"=> "Indianapolis Colts"
      ],
      [
        "name"=> "Iron Man"
      ],
      [
        "name"=> "Itachi"
      ],
      [
        "name"=> "Jack Skellington"
      ],
      [
        "name"=> "Jacksonville Jaguars"
      ],
      [
        "name"=> "Jameson Irish Whiskey Gifts"
      ],
      [
        "name"=> "Javier Báez"
      ],
      [
        "name"=> "Jesus"
      ],
      [
        "name"=> "Joker"
      ],
      [
        "name"=> "Jordan 1 High Sneaker Boots"
      ],
      [
        "name"=> "Jordan 4"
      ],
      [
        "name"=> "Juneteenth"
      ],
      [
        "name"=> "Kakashi"
      ],
      [
        "name"=> "Kansas City Chiefs"
      ],
      [
        "name"=> "Kansas Royals"
      ],
      [
        "name"=> "Kentucky Wildcats"
      ],
      [
        "name"=> "Kobe Bryant"
      ],
      [
        "name"=> "L Lawliet"
      ],
      [
        "name"=> "Las Vegas Raiders"
      ],
      [
        "name"=> "LeBron James"
      ],
      [
        "name"=> "leggings"
      ],
      [
        "name"=> "leggings and Tank Top"
      ],
      [
        "name"=> "Levi Ackerman"
      ],
      [
        "name"=> "light color shirts"
      ],
      [
        "name"=> "Light Yagami"
      ],
      [
        "name"=> "Los Angeles Angels"
      ],
      [
        "name"=> "Los Angeles Chargers"
      ],
      [
        "name"=> "Los Angeles Dodgers"
      ],
      [
        "name"=> "Los Angeles Kings"
      ],
      [
        "name"=> "Los Angeles Lakers"
      ],
      [
        "name"=> "Los Angeles Rams"
      ],
      [
        "name"=> "LSU Tigers"
      ],
      [
        "name"=> "Luffy"
      ],
      [
        "name"=> "Luke Skywalker"
      ],
      [
        "name"=> "Madara"
      ],
      [
        "name"=> "Marvel"
      ],
      [
        "name"=> "Miami Dolphins"
      ],
      [
        "name"=> "Miami Heat"
      ],
      [
        "name"=> "Miami Hurricanes"
      ],
      [
        "name"=> "Michigan Wolverines"
      ],
      [
        "name"=> "Mickey Mouse"
      ],
      [
        "name"=> "Mikasa Ackerman"
      ],
      [
        "name"=> "Mike Trout"
      ],
      [
        "name"=> "Milwaukee Brewers"
      ],
      [
        "name"=> "Milwaukee Bucks"
      ],
      [
        "name"=> "Minnesota Twins"
      ],
      [
        "name"=> "Minnesota Vikings"
      ],
      [
        "name"=> "Minnesota Wild"
      ],
      [
        "name"=> "Misa Amane"
      ],
      [
        "name"=> "MLB"
      ],
      [
        "name"=> "Montreal Canadiens"
      ],
      [
        "name"=> "Mother's Day"
      ],
      [
        "name"=> "Movie"
      ],
      [
        "name"=> "mug"
      ],
      [
        "name"=> "Music"
      ],
      [
        "name"=> "Naruto"
      ],
      [
        "name"=> "Nashville Predators"
      ],
      [
        "name"=> "NBA"
      ],
      [
        "name"=> "NCAA Football"
      ],
      [
        "name"=> "New Dad Gifts"
      ],
      [
        "name"=> "New England Patriots"
      ],
      [
        "name"=> "New Jersey Devils"
      ],
      [
        "name"=> "New Mom Gifts"
      ],
      [
        "name"=> "New Orleans Saints"
      ],
      [
        "name"=> "New York Giants"
      ],
      [
        "name"=> "New York Islanders"
      ],
      [
        "name"=> "New York Jets"
      ],
      [
        "name"=> "New York Rangers"
      ],
      [
        "name"=> "New York Yankees"
      ],
      [
        "name"=> "NFL"
      ],
      [
        "name"=> "NHL"
      ],
      [
        "name"=> "North Carolina Tar Heels"
      ],
      [
        "name"=> "Nurse"
      ],
      [
        "name"=> "Ohio State Buckeyes"
      ],
      [
        "name"=> "One piece"
      ],
      [
        "name"=> "Ottawa Senators"
      ],
      [
        "name"=> "Pabst Blue Ribbon Gifts"
      ],
      [
        "name"=> "Patrick Mahomes"
      ],
      [
        "name"=> "personalize Skate Shoes"
      ],
      [
        "name"=> "personalized 3D Hoodie"
      ],
      [
        "name"=> "personalized 3D T-Shirt"
      ],
      [
        "name"=> "personalized baseball Jersey"
      ],
      [
        "name"=> "Personalized Couple Hawaiian Shirt"
      ]
    ]];
print_r($woocommerce->post('products/categories/batch', $data2));
$data3 = [
  "create" => [
    [
        "name"=> "Personalized Gifts For Dad"
      ],
      [
        "name"=> "Personalized Gifts For Daughter"
      ],
      [
        "name"=> "Personalized Gifts For Husband"
      ],
      [
        "name"=> "Personalized Gifts For Mom"
      ],
      [
        "name"=> "Personalized Gifts For Son"
      ],
      [
        "name"=> "Personalized Gifts For Wife"
      ],
      [
        "name"=> "Personalized Hawaiian Shirt"
      ],
      [
        "name"=> "Personalized Image Hawaiian Shirt"
      ],
      [
        "name"=> "Personalized Image Tumblers"
      ],
      [
        "name"=> "personalized Jordan 1 High"
      ],
      [
        "name"=> "personalized Mug"
      ],
      [
        "name"=> "Personalized Pajama Set"
      ],
      [
        "name"=> "personalized T-Shirt"
      ],
      [
        "name"=> "Personalized Ugly Christmas Sweaters"
      ],
      [
        "name"=> "Pet Gifts"
      ],
      [
        "name"=> "Philadelphia Eagles"
      ],
      [
        "name"=> "Philadelphia Flyers"
      ],
      [
        "name"=> "Philadelphia Phillies"
      ],
      [
        "name"=> "Pink Floyd Gifts"
      ],
      [
        "name"=> "Pittsburgh Penguins"
      ],
      [
        "name"=> "Pittsburgh Steelers"
      ],
      [
        "name"=> "Pokemon"
      ],
      [
        "name"=> "Political"
      ],
      [
        "name"=> "poster"
      ],
      [
        "name"=> "premium 3D T-Shirt"
      ],
      [
        "name"=> "premium crocs"
      ],
      [
        "name"=> "premium Hawaiian Shirt"
      ],
      [
        "name"=> "premium Jordan 11 Shoe"
      ],
      [
        "name"=> "premium Jordan 13 Shoe"
      ],
      [
        "name"=> "premium Max Soul Shoes"
      ],
      [
        "name"=> "premium NAF Shoes"
      ],
      [
        "name"=> "premium Stan Smith Shoes"
      ],
      [
        "name"=> "Professions"
      ],
      [
        "name"=> "R2-D2"
      ],
      [
        "name"=> "Rolling The Stones Gifts"
      ],
      [
        "name"=> "Ryuk"
      ],
      [
        "name"=> "Saint Bernard Gifts"
      ],
      [
        "name"=> "San Diego Padres"
      ],
      [
        "name"=> "San Francisco 49ers"
      ],
      [
        "name"=> "San Francisco Giants"
      ],
      [
        "name"=> "San Jose Sharks"
      ],
      [
        "name"=> "Sanji"
      ],
      [
        "name"=> "Sasuke"
      ],
      [
        "name"=> "Seattle Kraken"
      ],
      [
        "name"=> "Seattle Seahawks"
      ],
      [
        "name"=> "shoes"
      ],
      [
        "name"=> "Shop The Holiday"
      ],
      [
        "name"=> "Sidney Crosby"
      ],
      [
        "name"=> "Sneakers"
      ],
      [
        "name"=> "Snoopy Gifts"
      ],
      [
        "name"=> "Son Goku"
      ],
      [
        "name"=> "Special Occasion Gifts"
      ],
      [
        "name"=> "Sport"
      ],
      [
        "name"=> "St. Louis Blues"
      ],
      [
        "name"=> "St. Louis Cardinals"
      ],
      [
        "name"=> "St. Patrick's Day"
      ],
      [
        "name"=> "Star wars"
      ],
      [
        "name"=> "Stefon Diggs"
      ],
      [
        "name"=> "Step Dad Gifts"
      ],
      [
        "name"=> "Step Mom Gifts"
      ],
      [
        "name"=> "Stephen Curry"
      ],
      [
        "name"=> "Stitch"
      ],
      [
        "name"=> "Superman"
      ],
      [
        "name"=> "t-shirt"
      ],
      [
        "name"=> "Tampa Bay Buccaneers"
      ],
      [
        "name"=> "Tampa Bay Lightning"
      ],
      [
        "name"=> "Tampa Bay Rays"
      ],
      [
        "name"=> "Tennessee Titans"
      ],
      [
        "name"=> "Texas Longhorns"
      ],
      [
        "name"=> "Thanksgiving"
      ],
      [
        "name"=> "The Beatles Gifts"
      ],
      [
        "name"=> "Thor"
      ],
      [
        "name"=> "Tito’s Vodka Gifts"
      ],
      [
        "name"=> "Tom Brady"
      ],
      [
        "name"=> "Toronto Maple Leafs"
      ],
      [
        "name"=> "Travis Kelce"
      ],
      [
        "name"=> "Trending"
      ],
      [
        "name"=> "Trucker"
      ],
      [
        "name"=> "tumblers"
      ],
      [
        "name"=> "UCLA Bruins"
      ],
      [
        "name"=> "Ugly Christmas Sweaters"
      ],
      [
        "name"=> "Utah Jazz"
      ],
      [
        "name"=> "Uzumaki Naruto"
      ],
      [
        "name"=> "Valentine"
      ],
      [
        "name"=> "Vancouver Canucks Gifts"
      ],
      [
        "name"=> "Vegas Golden Knights Gifts"
      ],
      [
        "name"=> "Veterans Day"
      ],
      [
        "name"=> "vintage 3D Hoodie"
      ],
      [
        "name"=> "Washington Capitals Gifts"
      ],
      [
        "name"=> "Washington Commanders"
      ],
      [
        "name"=> "Wayne Gretzky"
      ],
      [
        "name"=> "Wedding Gifts"
      ],
      [
        "name"=> "Wine"
      ],
      [
        "name"=> "wine tumbler"
      ],
      [
        "name"=> "Winnie The Pooh"
      ],
      [
        "name"=> "Winnipeg Jets Gifts"
      ],
      [
        "name"=> "Wonder Woman"
      ],
      [
        "name"=> "Wu-Tang Clan Gifts"
      ],
      [
        "name"=> "Yeezy Boost"
      ],
      [
        "name"=> "Zoro"
      ]
    ]];

print_r($woocommerce->post('products/categories/batch', $data3));
?>

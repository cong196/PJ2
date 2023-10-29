
function tagbyTitle($title) {
	const textList = [
	    // NFL teams
	    "Arizona Cardinals", "Atlanta Falcons", "Baltimore Ravens", "Buffalo Bills", "Carolina Panthers", "Chicago Bears", 
	    "Cincinnati Bengals", "Cleveland Browns", "Dallas Cowboys", "Denver Broncos", "Detroit Lions", "Green Bay Packers", 
	    "Houston Texans", "Indianapolis Colts", "Jacksonville Jaguars", "Kansas City Chiefs", "Las Vegas Raiders", "Los Angeles Chargers", 
	    "Los Angeles Rams", "Miami Dolphins", "Minnesota Vikings", "New England Patriots", "New Orleans Saints", "New York Giants", 
	    "New York Jets", "Philadelphia Eagles", "Pittsburgh Steelers", "San Francisco 49ers", "Seattle Seahawks", "Tampa Bay Buccaneers", 
	    "Tennessee Titans", "Washington Football Team","Washington Commanders",

	    // NBA teams
	    "Atlanta Hawks", "Boston Celtics", "Brooklyn Nets", "Charlotte Hornets", "Chicago Bulls", "Cleveland Cavaliers", "Dallas Mavericks", 
	    "Denver Nuggets", "Detroit Pistons", "Golden State Warriors", "Houston Rockets", "Indiana Pacers", "Los Angeles Clippers", 
	    "Los Angeles Lakers", "Memphis Grizzlies", "Miami Heat", "Milwaukee Bucks", "Minnesota Timberwolves", "New Orleans Pelicans", 
	    "New York Knicks", "Oklahoma City Thunder", "Orlando Magic", "Philadelphia 76ers", "Phoenix Suns", "Portland Trail Blazers", 
	    "Sacramento Kings", "San Antonio Spurs", "Toronto Raptors", "Utah Jazz", "Washington Wizards",

	    // MLB teams
	    "Arizona Diamondbacks", "Atlanta Braves", "Baltimore Orioles", "Boston Red Sox", "Chicago White Sox", "Chicago Cubs", 
	    "Cincinnati Reds", "Cleveland Guardians", "Colorado Rockies", "Detroit Tigers", "Houston Astros", "Kansas City Royals", 
	    "Los Angeles Angels", "Los Angeles Dodgers", "Miami Marlins", "Milwaukee Brewers", "Minnesota Twins", "New York Yankees", 
	    "New York Mets", "Oakland Athletics", "Philadelphia Phillies", "Pittsburgh Pirates", "San Diego Padres", "San Francisco Giants", 
	    "Seattle Mariners", "St. Louis Cardinals", "Tampa Bay Rays", "Texas Rangers", "Toronto Blue Jays", "Washington Nationals",

	    // NHL teams
	    "Anaheim Ducks", "Arizona Coyotes", "Boston Bruins", "Buffalo Sabres", "Calgary Flames", "Carolina Hurricanes", "Chicago Blackhawks", 
	    "Colorado Avalanche", "Columbus Blue Jackets", "Dallas Stars", "Detroit Red Wings", "Edmonton Oilers", "Florida Panthers", 
	    "Los Angeles Kings", "Minnesota Wild", "Montreal Canadiens", "Nashville Predators", "New Jersey Devils", "New York Islanders", 
	    "New York Rangers", "Ottawa Senators", "Philadelphia Flyers", "Pittsburgh Penguins", "San Jose Sharks", "Seattle Kraken", 
	    "St. Louis Blues", "Tampa Bay Lightning", "Toronto Maple Leafs", "Vancouver Canucks", "Vegas Golden Knights", "Washington Capitals", 
	    "Winnipeg Jets",

	    //NACC teams
	    "Boston College Eagles","Clemson Tigers","Duke Blue Devils","Florida State Seminoles","Georgia Tech Yellow Jackets","Louisville Cardinals",
	    "Miami Hurricanes","North Carolina Tar Heels","North Carolina State Wolfpack","Pittsburgh Panthers","Syracuse Orange","Virginia Cavaliers",
	    "Virginia Tech Hokies","Wake Forest Demon Deacons","Baylor Bears","Iowa State Cyclones","Kansas Jayhawks","Kansas State Wildcats","Oklahoma Sooners",
	    "Oklahoma State Cowboys","TCU Horned Frogs","Texas Longhorns","Texas Tech Red Raiders","West Virginia Mountaineers","Illinois Fighting Illini",
	    "Indiana Hoosiers","Iowa Hawkeyes","Maryland Terrapins","Michigan Wolverines","Michigan State Spartans","Minnesota Golden Gophers",
	    "Nebraska Cornhuskers","Northwestern Wildcats","Ohio State Buckeyes","Penn State Nittany Lions","Purdue Boilermakers",
	    "Rutgers Scarlet Knights","Wisconsin Badgers","Arizona Wildcats","Arizona State Sun Devils","California Golden Bears","Colorado Buffaloes",
	    "Oregon Ducks","Oregon State Beavers","Stanford Cardinal","UCLA Bruins","USC Trojans","Utah Utes","Washington Huskies",
	    "Washington State Cougars","Alabama Crimson Tide","Arkansas Razorbacks","Auburn Tigers","Florida Gators","Georgia Bulldogs",
	    "Kentucky Wildcats","LSU Tigers","Mississippi State Bulldogs","Missouri Tigers","Ole Miss Rebels","South Carolina Gamecocks",
		"Tennessee Volunteers", "Texas A&M Aggies", "Vanderbilt Commodores", "notre dame fighting irish", "Purdue Boilermakers",

		"Snoopy","Baby Yoda","Harry Potter"
	];

	function findMatch(textList, str) {
		let matches = [];
	 	for (const text of textList) {
		    if (str.toLowerCase().includes(text.toLowerCase())) {
	            matches.push(text);
	        }
		 }
	  return matches;
	}

	var result = findMatch(textList, $title);
	return result.join(',');
}

function productTypebyTitle(title) {
    const titleClassifier = {
        categories: {
            "hoodie": "hoodie",
            "shirt": "shirt",
            "hawaiian shirt": "shirt",
            "crocs": "shoes",
            "jordan 13": "shoes",
            "sneaker" : "shoes",
            "sweatshirt": "sweater",
            "sweater": "sweater"
        },

        classifyTitle: function(innerTitle) {
            const lowerCaseTitle = innerTitle.toLowerCase();
            for (let keyword in this.categories) {
                if (lowerCaseTitle.includes(keyword)) {
                    return this.categories[keyword];
                }
            }
            return "";
        }
    };

    return titleClassifier.classifyTitle(title);
}

function getTag(title) {
	if(tagbyTitle(title) == '') {
		return "";
	} else {
		if(productTypebyTitle(title) == '') {
			return tagbyTitle(title);
		} else {
			const data = tagbyTitle(title).split(',').map(name => name.trim());
			const extendedType = data.map(name => `${name} ${productTypebyTitle(title)}`);
			return data.concat(extendedType).join(',');
			/*let data = tagbyTitle(title).split(',');
			let updatedTags = data.map(tag => tag.trim() + ' ' + productTypebyTitle(title) + ','+ tag.trim());
			updatedTags.join(',').toString();
			//return tagbyTitle(title) + ' ' + productTypebyTitle(title) + ',' + tagbyTitle(title);
			return updatedTags;*/

		}
	}
}
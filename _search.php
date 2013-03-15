<?

/*
Google http://www.google.com/search?q=star+trek
http://www.bing.com/search?q=star+trek
Amazon http://www.amazon.com/s/ref=nb_ss_gw?url=search-alias%3Daps&field-keywords=star+trek
Wolfram Alpha http://www37.wolframalpha.com/input/?i=star+trek
IMDB http://www.imdb.com/find?s=all&q=star+trek
Price Grabber http://www.pricegrabber.com/star+trek/products.html/form_keyword=star+trek
Flickr CC http://www.flickr.com/search/?l=cc&q=star%20trek

<option value="google">Google</option>
<option value="amazon">Amazon</option>
<option value="wolfram">Wolfram Alpha</option>
<option value="wikipedia">Wikipedia</option>
<option value="imdb">IMDB</option>
<option value="pricegrabber">Price Grabber</option>
<option value="creativecommons">Creative Commons</option>

*/

$query = urlencode($_GET["query"]);

switch ($_GET["search"]) {

	case "amazon":
		header( 'Location: http://www.amazon.com/s/ref=nb_ss_gw?url=search-alias%3Daps&field-keywords=' . $query);
		break;
	
	case "wolfram":
		header( 'Location: http://www37.wolframalpha.com/input/?i=' . $query);
		break;
	
	case "imdb":
		header( 'Location: http://www.imdb.com/find?s=all&q=' . $query);
		break;
		
	case "pricegrabber":
		header( 'Location: http://www.pricegrabber.com/star+trek/products.html/form_keyword=' . $query);
		break;
		
	case "wikipedia":
		header( 'Location: http://en.wikipedia.org/wiki/Special:Search?search=' . $query);
		break;

	case "flickrcc":
		header( 'Location: http://www.flickr.com/search/?l=cc&q=' . $query);
		break;
		
	case "bing":
  		header( 'Location: http://www.bing.com/search?q=' . $query);
  		break;
	
	default:
		header( 'Location: http://www.google.com/search?q=' . $query);
}

?>


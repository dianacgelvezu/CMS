<?php
/**
 * @copyright Copyright (C) 2015 GPIUTMD. All rights reserved.
 * @copyright Copyright (C) 2005-2015 Open Source Matters, Inc. All rights reserved.
 * @license GNU General Public License version 3 or Later; see http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$doc = JFactory::getDocument();
$doc->addStyleSheet("modules/mod_myapplestylecounter/tmpl/assets/counterstylesheet.css");
echo '<!-- My Apple Style Counter Module for Joomla 3.x - GPIUTMD Joomla Extensions - Nima Nouri; Chris Nanney -->';
?>

<div id="counterwrap">
	<div id="countercontainer"></div>
	<div id="countercopyright">
		<p>© 2009-2015 by <a href="http://gpiutmd.iut.ac.ir/">GPIUTMD</a></p>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript">
var myAppleCounterJQ = jQuery.noConflict();
myAppleCounterJQ(function() {
//<![CDATA[

// Array to hold each digit's starting background-position Y value
var initialPos = [0, -312, -624, -936, -1248, -1560, -1872, -2184, -2496, -2808];
// Amination frames
var animationFrames = 5;
// Frame shift
var frameShift = 52;
// Starting number
<?php
    $db    = JFactory::getDbo();
    $query= $db->getQuery(true);
    $query->clear();
    $query->select('SUM(hits) AS count_hits');
    $query->from('#__content');
    $query->where('state = 1');
    $db->setQuery($query);
    $hits = $db->loadResult();
?>;
// start number of counting
var startnum = <?php echo $params->get( 'startnum', '0' ); ?>;
// Increment
var increment = <?php echo $params->get( 'increment', '1' ); ?>;
// Pace of counting in milliseconds
var pace = <?php echo $params->get( 'interval', '1000000.0' ); ?>;

var animateinterval = [];
var myk = [];

var theNumber = increment*(<?php echo $hits ?> + startnum);

// Function that controls counting
function doCount(){
    var x = theNumber.toString();
    theNumber += increment;
    var y = theNumber.toString();
    digitCheck(x,y);
}

// This checks the old count value vs. new value, to determine how many digits
// have changed and need to be animated.
function digitCheck(x,y){
    var digitsOld = splitToArray(x);
    var digitsNew = splitToArray(y);
    for (var i = 0, c = digitsNew.length; i < c; i++){
        if (digitsNew[i] != digitsOld[i]){
            animateDigit(i, digitsOld[i], digitsNew[i]);
        }
    }
}

// Animation function
function animateDigit(n, oldDigit, newDigit) {
	// I want three different animations speeds based on the digit,
	// because the pace and increment is so high. If it was counting
	// slower, just one speed would do.
	// 1: Changes so fast is just like a blur
	// 2: You can see complete animation, barely
	// 3: Nice and slow
	var speed;
	switch (n) {
		case 0:
			speed = pace / 20.0;
			break;
		case 1:
			speed = pace / 15.0;
			break;
		default:
			speed = pace / 10.0;
			break;
	}
	// Cap on slowest animation can go
	speed = (speed > 100) ? 100 : speed;
	// Get the initial Y value of background position to begin animation
	var pos = initialPos[oldDigit];
	// Each animation is 5 frames long, and 52px down the background image.
	// We delay each frame according to the speed we determined above.
	myk[n] = 0;

	animateinterval[n] = setInterval(function () {
		myk[n] += 1;
		pos -= frameShift;
		if (myk[n] == (animationFrames - 1)) {
			pos = initialPos[newDigit];
			(myAppleCounterJQ)("#d" + n).css({
				'background-position': '0 ' + initialPos[newDigit] + 'px'
			});
			myk[n] = 0;
			clearInterval(animateinterval[n]);
		} else {
			(myAppleCounterJQ)("#d" + n).css({
				'background-position': '0 ' + pos + 'px'
			});
		}
	}, speed);
}

// Splits each value into an array of digits
function splitToArray(input){
    var digits = new Array();
    for (var i = 0, c = input.length; i < c; i++){
        var subStart = input.length - (i + 1);
        var subEnd = input.length - i;
        digits[i] = input.substring(subStart, subEnd);
    }
    return digits;
}

// Sets the correct digits on load
function initialDigitCheck(initial){
	// Creates the html
    var digits = splitToArray(initial.toString());
	html='';
	for (var i = 0, c = digits.length; i < c; i++){
	    html = '<div class="counterdigit" id="d'+i+'"></div>' + html;
		if (((i+1)%3)==0 && (i+1)<c) html = '<div class="counterseperator"></div>' + html;
		}
	// setting the number digits
	(myAppleCounterJQ)("#countercontainer").append(html);
    for (var i = 0, c = digits.length; i < c; i++){
        (myAppleCounterJQ)("#d" + i).css({'background-position': '0 ' + initialPos[digits[i]] + 'px'});
    }
}
    initialDigitCheck(theNumber);
    doCount();
//    setInterval(doCount, pace);
});

//]]>
</script>
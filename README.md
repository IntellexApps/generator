# Dummy data generator for PHP 

[Examples](#examples) and full [list of supported generators](#list-of-all-generators) below.

##### Image:
* Image URL generator from [Pixabay](https://pixabay.com) service (requires free API key).

##### Core:
* Boolean generator with __selectable chance__ of true.
* Get a number in range, with or without __Gaussian distribution__.
* Random item from __weighted array__, allows you to manipulate chances.
* Random __date time__ from a period, in __any format__.

##### Text and HTML:
* Generate __random strings__ from custom or predefined pools of characters.
* __Lorem ipsum__ text generator that supports: single word, __variable length__ sentences, full paragraphs and complete articles.
* Full HTML generator for __decorated sentences__, paragraphs or full-out article __with images__ (requires free [Pixabay]((https://pixabay.com)) API key).

##### Bonus
* Generate a __GPS coordinate__, that is a maximum of meters away from any center you choose. 
* A hardcoded generator that always returns the same results, just for good measure :)


Examples
--------------------

__Tip:__ After cloning, point browser to tests/index.php to see every possible result.  

Image:
<pre>echo '&lt;img src="' . (new PixabayImageURLGen($pixabayAPIKey, [ 'q' => 'kitten' ], PixabayImageURLGen::SIZE_960))->gen() . '" /&gt;';</pre>

GPS location within 3000 meters from the city centre of Amsterdam, Netherlands:
<pre>(new \Intellex\Generator\Plus\GpsLocationGen(52.3677607, 4.8785829, 3000));</pre>

Boolean with 50% chance of true:
<pre>(new BooleanGen())->gen();</pre>

Boolean with 80% chance of true:
<pre>(new BooleanGen(0.8))->gen();</pre>

Random number in range of 50 - 250:
<pre>(new NumericGen(50, 250))->gen();</pre>

Random number of mean 38 and mean 5 (Gaussian distribution):
<pre>(new GaussianDistributionGen(38, 4))->gen();</pre>

Random item from array:
<pre>(new ItemGen([ 1, 2, 3, 5, 7, 11 ]))->gen();</pre>

Random weighted item from array, where is 2 times more likely than B and 6 times more likely than C:
<pre>(new WeightedItemGen([ 'A' => 6, 'B' => 3, 'C' => 1 ]))->gen();</pre>

Full HTML article, with images:
<pre>(new HTMLArticleGen(true, $pixabayAPIKey))->gen();</pre>


List of all generators
--------------------
Core:
* __BooleanGen__ generates a boolean value, with the ability to give more chances to any of the results.
* __NumericGen__ generates a random number in a specified range.
* __GaussianDistributionGen__ uses a normal distribution to pick a random value in a range.
* __HardcodedGen__ uses the value supplied in the constructor as a generated value, every time.
* __ItemGen__ picks an item from the pool, where every item has the same change of being picked.
* __WeightedItemGen__ picks a random item from the pool, with the ability to influence the change of picking for each item.

Bonus:
* __GpsLocationGen__ generates a GPS location, within a supplied radius of a given central point. Output format is <decimal>,<decimal>, with a maximum of 6 decimal digit precision.
* __PixabayImageURLGen__ generates a URL to a random image on the Pixabay free image service, using their API.

Time:
* __TimestampGen__ generates a random timestamp in a given range.
* __DateTimeGen__ generates a random date in YYYY-MM-DD hh:mm:ss format.
* __DateGen__ generates a random date in YYYY-MM-DD format.
* __TimeGen__ generates a time in 24h format.

Strings and text:
* __StringGen__ generates a random string.
* __WordGen__ generates a single word, from a predefined "lorem ipsum" dictionary.
* __SentenceGenerator__ generates a dummy sentence.
* __ParagraphGen__ generates a random paragraph from random sentences.
* __ArticleGen__ generates a random article form random paragraphs.

HTML:
* __HTMLSentenceGen__ generates a random sentences with random HTML tags, such as b, strong, em, etc...
* __HTMLParagraphGen__ generates a valid HTML paragraph.
* __HTMLSectionGen__ generates an HTML header with random paragraphs.
* __HTMLArticleGen__ generates a complete HTML article.


To do
--------------------
1. Testing of the results.
2. Better implementation of the WeightedItemGen.
3. Setters for all constructor parameters for all generators.
4. New generators.


Licence
--------------------
MIT License

Copyright (c) 2019 Intellex

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


Credits
--------------------
Script has been written by the [Intellex](https://intellex.rs/en) team.


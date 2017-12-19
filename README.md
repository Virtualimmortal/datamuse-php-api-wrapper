# datamuse-php-api-wrapper

A PHP wrapper for the datamuse.com API.

## Structure

```
src/
tests/
vendor/
```

## Install

Via Composer

```bash
$ composer require undeadyetii/datamuse-php-api-wrapper
```

## Usage

##### Options:

There are a 4 different methods of calling an option/relation. Below is a table showing each way.

```
Command Name        API Code      RhymeOpt Constant              Setter Method
Plain Text          Abbreviation  Uppercase Snake Case           Camel Case

means like          ml            RhymeOpt::MEANS_LIKE           meansLike()
sounds like         sl            RhymeOpt::SOUNDS_LIKE          soundsLike()
spelled like        sp            RhymeOpt::SPELLED_LIKE         spelledLike()
nouns by adjective  rel_jja       RhymeOpt::NOUNS_BY_ADJECTIVE   nounsByAdjective()
adjectives by noun  rel_jjb       RhymeOpt::ADJECTIVES_BY_NOUN   adjectivesByNoun()
synonyms of         rel_syn       RhymeOpt::SYNONYMS_OF          synonymsOf()
triggers of         rel_trg       RhymeOpt::TRIGGERS_OF          triggersOf()
antonyms of         rel_ant       RhymeOpt::ANTONYMS_OF          antonymsOf()
more specific than  rel_spc       RhymeOpt::MORE_SPECIFIC_THAN   moreSpecificThan()
more general than   rel_gen       RhymeOpt::MORE_GENERAL_THAN    moreGeneralThan()
comprises of        rel_com       RhymeOpt::COMPRISES_OF         comprisesOf()
part of             rel_par       RhymeOpt::PART_OF              partOf()
words following     rel_bga       RhymeOpt::WORDS_FOLLOWING      wordsFollowing()
words preceding     rel_bgb       RhymeOpt::WORDS_PRECEDING      wordsPreceding()
perfect rhymes      rel_rhy       RhymeOpt::PERFECT_RHYMES       perfectRhymes()
approximate rhymes  rel_nry       RhymeOpt::APPROX_RHYMES        approximateRhymes()
homophones of       rel_hom       RhymeOpt::HOMOPHONES_OF        homophonesOf()
matches consonants  rel_cns       RhymeOpt::MATCHES_CONSONANT    matchesConsonants()
of topic            topics        RhymeOpt::OF_TOPIC             ofTopic()
left context        lc            RhymeOpt::LEFT_CONTEXT         leftContext()
right context       rc            RhymeOpt::RIGHT_CONTEXT        rightContext()
```

They are used to specify a relation in order to build your response (read more at https://datamuse.com/api)
Below shows you how to use these codes.

##### PHP Code Example:

```php
use \YeTii\DatamuseApi\RhymeOpt;
use \YeTii\DatamuseApi\ApiClient;
$client = new ApiClient();

// Set option (following 4 lines produce same result)
$client->setOpt('spelled like', 'elepant');          // uses Command Name      | passes 'elepant' as the word
$client->setOpt('sp', 'elepant');                    // uses API Code          | passes 'elepant' as the word
$client->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');  // uses RhymeOpt Constant | passes 'elepant' as the word
$client->spelledLike('elepant');                     // uses Setter Method     | passes 'elepant' as the word

// Get the words (returns ApiClient instance still)
$client->getWords();
// Get the result array:
$result = $client->result;
// Get where the result is from (cache or fresh from api):
$result_from = $client->result_from; // `cache` or `api`

// Setting multiple options (you can mix an match Command Names / Code / RhymeOpt Constants)
$client->setOpts([
	RhymeOpt::SPELLED_LIKE => 'elepant',
	'of topic' => 'animals'
]);

// You can chain the commands (again, you can mix and match):
$result = $client->setOpt(RhymeOpt::EXACT, 'bake')->ofTopic('food')->getWords()->result;
// Find exact rhymes of the word "bake" that relate to the topic "food", get the words and give me the results

// Result: Now you have your cake.
```

##### Caching:

Caching uses `inouet/file-cache` package (read more at https://github.com/inouet/file-cache)

```php
use \YeTii\DatamuseApi\ApiClient;
$time = 86400; // time in seconds before cache should expire; default:86400; should be no less than 86400
$dir = __DIR__.'/cache'; // absolute path of folder to store cache in
$client = new ApiClient([
	'cache_lifetime'=>$time,
	'cache_dir'=>$dir
]);

$result = $client->setOpt(RhymeOpt::EXACT, 'bake')->ofTopic('food')->getWords()->result; // not cached
// now exact_rhyme:bake|of_topic:food is now cached.
$result = $client->setOpt(RhymeOpt::EXACT, 'bake')->ofTopic('food')->getWords()->result; // cached

// DISABLING CACHE (not recommended -- if you do, add your own caching methods)
$client = new ApiClient([
	'cache_enable'=>false, // to disable
]);
// alternatively, setting cache_lifetime to 0 should work too, but cache_enable=>false will completely stop caching
```

## Testing

``` bash
$ composer test
```

## Credits

- [undeadyetii][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[link-packagist]: https://packagist.org/packages/undeadyetii/datamuse-php-api-wrapper
[link-author]: https://github.com/undeadyetii
[link-contributors]: ../../contributors

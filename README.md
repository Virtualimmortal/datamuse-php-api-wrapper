# datamuse-php-api-wrapper
A PHP API Wrapper for datamuse.com


## Usage
##### Options:
There are a collection of different methods you can use:
```
Command Name 		Code        RhymeOpt Constant              Setter Method

means like          ml          RhymeOpt::MEANS_LIKE           meansLike()
sounds like         sl          RhymeOpt::SOUNDS_LIKE          soundsLike()
spelled like        sp          RhymeOpt::SPELLED_LIKE         spelledLike()
nouns by adjective  rel_jja     RhymeOpt::NOUNS_BY_ADJECTIVE   nounsByAdjective()
adjectives by noun  rel_jjb     RhymeOpt::ADJECTIVES_BY_NOUN   adjectivesByNoun()
synonyms of         rel_syn     RhymeOpt::SYNONYMS             synonymsOf()
triggers of         rel_trg     RhymeOpt::TRIGGERS             triggersOf()
antonyms of         rel_ant     RhymeOpt::ANTONYMS             antonymsOf()
more specific than  rel_spc     RhymeOpt::MORE_SPECIFIC        moreSpecificThan()
more general than   rel_gen     RhymeOpt::MORE_GENERAL         moreGeneralThan()
comprises of        rel_com     RhymeOpt::COMPRISES            comprisesOf()
part of             rel_par     RhymeOpt::PART_OF              partOf()
words following     rel_bga     RhymeOpt::WORDS_FOLLOWING      wordsFollowing()
words preceding     rel_bgb     RhymeOpt::WORDS_PRECEDING      wordsPreceding()
perfect rhymes      rel_rhy     RhymeOpt::EXACT                perfectRhymes()
approximate rhymes  rel_nry     RhymeOpt::APPROX               approximateRhymes()
homophones of       rel_hom     RhymeOpt::HOMOPHONES           homophonesOf()
matches consonants  rel_cns     RhymeOpt::CONSONANT_MATCH      matchesConsonants()
of topic            topics      RhymeOpt::TOPIC                ofTopic()
left context        lc          RhymeOpt::LEFT_CONTEXT         leftContext()
right context       rc          RhymeOpt::RIGHT_CONTEXT        rightContext()
```

##### PHP Code Example:
```php
use \YeTii\RhymeGenerator\RhymeOpt;
use \YeTii\RhymeGenerator\ApiClient;
$client = new ApiClient();

// Set option (following 3 lines produce same result)
$client->setOpt('spelled like', 'elepant');
$client->setOpt('sp', 'elepant');
$client->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant');
$client->spelledLike('elepant');

// Get the words (returns ApiClient instance still)
$client->getWords();
// Get the result array:
$result = $client->result;

// Setting multiple options (you can mix an match Command Names / Code / RhymeOpt Constants)
$client->setOpts([
	RhymeOpt::SPELLED_LIKE => 'elepant',
	'of topic' => 'animals'
]);

// You can chain the commands (again, you can mix and match):
$result = $client->setOpt(RhymeOpt::SPELLED_LIKE, 'elepant')->ofTopic('animals')->getWords()->result;```
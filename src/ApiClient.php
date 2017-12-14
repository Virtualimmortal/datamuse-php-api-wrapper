<?php
namespace YeTii\RhymeGenerator;

use FileCache;
use YeTii\General\Str;

class ApiClient {

	protected $result = [];
	protected $result_count = 0;
	protected $result_from = null;

	protected $parameters = [];
	protected $query = null;
	protected $query_url = null;

	protected $tmp = [];

	protected $available_parameters = [
		'ml'=>'means like',
		'sl'=>'sounds like',
		'sp'=>'spelled like',
		'rel_jja'=>'nouns by adjective',
		'rel_jjb'=>'adjectives by noun',
		'rel_syn'=>'synonyms of',
		'rel_trg'=>'triggers of',
		'rel_ant'=>'antonyms of',
		'rel_spc'=>'more specific than',
		'rel_gen'=>'more general than',
		'rel_com'=>'comprises of',
		'rel_par'=>'part of',
		'rel_bga'=>'words following',
		'rel_bgb'=>'words preceding',
		'rel_rhy'=>'perfect rhymes',
		'rel_nry'=>'approximate rhymes',
		'rel_hom'=>'homophones of',
		'rel_cns'=>'matches consonants',
		'topics'=>'of topic',
		'lc'=>'left context',
		'rc'=>'right context'
	];

	protected $cache_lifetime = 86400;

	public function __call($name, $args) {
		if (!isset($args[0])) return $this;
		$str = (string)Str::normalCase($name);
		foreach ($this->available_parameters as $key => $value) {
			if ($value==$str||$key==$str) {
				$this->setOpt($key, $args[0]);
				break;
			}
		}
		return $this;
	}

	public function __construct(array $args = null) {
		if (isset($args['cache_lifetime'])) {
			$this->cache_lifetime = $args['cache_lifetime'];
			unset($args['cache_lifetime']);
		}
		$this->setOpts($args);

		$this->cache = new FileCache(['cache_dir'=>__DIR__.'/cache']);
	}

	public function setOpts(array $args = null) {
		if (is_array($args)) {
			foreach ($args as $key=>$value) {
				$this->setOpt((string)$key, (string)$value);
			}
		}
		return $this;
	}

	public function setOpt(string $key, string $value) {
		if (isset($this->available_parameters[$key])) {
			$this->parameters[$key] = $value;
		}
		return $this;
	}

	public function getWords() {
		if (count($this->parameters)) {
			$url = 'https://api.datamuse.com/words?';
			$this->parameters['max'] = 1000;
			$query = [];
			foreach ($this->parameters as $key => $value) {
				$value = urlencode($value);
				$url .= "{$key}={$value}&";
				if ($key!='max')
					$query[] = "{$this->available_parameters[$key]} `{$value}`";
			}
			$url = rtrim($url, '&');
			$content = $this->cache->get($url);
			$this->result_from = 'cache';
			if (!$content) {
				$this->result_from = 'curl';
				$content = file_get_contents($url);
				if (strlen($content) && $content = json_decode($content)) {
					$this->cache->save($url, $content, $this->cache_lifetime);
				}
			}
			$this->result = $content;
			$this->result_count = count($content);
			$this->query = implode("\n", $query);
			$this->query_url = Str::afterFirst($url, '?')->toString();
		}
		return $this;
	}

    public function getParameter(string $parameter)
    {
        if (isset($this->parameters[$parameter])) {
            return $this->parameters[$parameter];
        }

        return null;
    }

    public function getResult()
    {
        return $this->result;
    }
}
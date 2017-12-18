<?php

namespace YeTii\DatamuseApi;

use FileCache;
use YeTii\General\Str;

class ApiClient
{
    protected $result = [];
    protected $result_count = 0;
    protected $result_from = null;

    protected $parameters = [];
    protected $query = null;
    protected $query_url = null;

    protected $tmp = [];

    protected $available_parameters = [
        'ml'      => 'means like',
        'sl'      => 'sounds like',
        'sp'      => 'spelled like',
        'rel_jja' => 'nouns by adjective',
        'rel_jjb' => 'adjectives by noun',
        'rel_syn' => 'synonyms of',
        'rel_trg' => 'triggers of',
        'rel_ant' => 'antonyms of',
        'rel_spc' => 'more specific than',
        'rel_gen' => 'more general than',
        'rel_com' => 'comprises of',
        'rel_par' => 'part of',
        'rel_bga' => 'words following',
        'rel_bgb' => 'words preceding',
        'rel_rhy' => 'perfect rhymes',
        'rel_nry' => 'approximate rhymes',
        'rel_hom' => 'homophones of',
        'rel_cns' => 'matches consonants',
        'topics'  => 'of topic',
        'lc'      => 'left context',
        'rc'      => 'right context',
    ];

    protected $cache_enable = true;
    protected $cache_lifetime = 86400;
    protected $cache_dir = __DIR__.'/cache';
    protected $cache;

    public function __call($name, $args)
    {
        if (!isset($args[0])) {
            return $this;
        }
        $str = (string)Str::normalCase($name);
        foreach ($this->available_parameters as $key => $value) {
            if ($value == $str || $key == $str) {
                $this->setOpt($key, $args[0]);
                break;
            }
        }
        return $this;
    }

    public function __get($name)
    {
        return isset($this->{$name}) ? $this->{$name} : null;
    }

    public function __construct(array $args = null)
    {
        foreach (['cache_dir','cache_lifetime','cache_enable'] as $key) {
            if (isset($args[$key])) {
                $this->{$key} = $args[$key];
                unset($args[$key]);
            }
        }
        $this->setOpts($args);

        if ($this->cache_enable)
            $this->cache = new FileCache(['cache_dir' => $this->cache_dir]);
    }

    public function setOpts(array $args = null)
    {
        if (is_array($args)) {
            foreach ($args as $key => $value) {
                $this->setOpt((string)$key, (string)$value);
            }
        }
        return $this;
    }

    public function setOpt(string $key, string $value)
    {
        if (isset($this->available_parameters[$key])) {
            $this->parameters[$key] = $value;
        }
        return $this;
    }

    public function getWords()
    {
        if (count($this->parameters)) {
            $url = 'https://api.datamuse.com/words?';
            $this->parameters['max'] = 1000;
            $query = [];
            foreach ($this->parameters as $key => $value) {
                $value = urlencode($value);
                $url .= "{$key}={$value}&";
                if ($key != 'max') {
                    $query[] = "{$this->available_parameters[$key]} `{$value}`";
                }
            }
            $url = rtrim($url, '&');
            $content = $this->cache_enable ? $this->cache->get($url) : null;
            $this->result_from = 'cache';
            if (!$content) {
                $this->result_from = 'api';
                $content = file_get_contents($url);
                if (strlen($content) && $content = json_decode($content)) {
                    if ($this->cache_enable)
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
        return isset($this->parameters[$parameter]) ? $this->parameters[$parameter] : null;
    }

    public function getResult()
    {
        return $this->result;
    }
}

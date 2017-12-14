<?php

namespace YeTii\RhymeGenerator;

class RhymeOpt
{
    const MEANS_LIKE = 'ml';
    const SOUNDS_LIKE = 'sl';
    const SPELLED_LIKE = 'sp';
    const NOUNS_BY_ADJECTIVE = 'rel_jja';
    const ADJECTIVES_BY_NOUN = 'rel_jjb';
    const SYNONYMS = 'rel_syn';
    const TRIGGERS = 'rel_trg';
    const ANTONYMS = 'rel_ant';
    const MORE_SPECIFIC = 'rel_spc';
    const MORE_GENERAL = 'rel_gen';
    const COMPRISES = 'rel_com';
    const PART_OF = 'rel_par';
    const WORDS_FOLLOWING = 'rel_bga';
    const WORDS_PRECEDING = 'rel_bgb';
    const EXACT = 'rel_rhy';
    const APPROX = 'rel_nry';
    const HOMOPHONES = 'rel_hom';
    const CONSONANT_MATCH = 'rel_cns';
    const TOPIC = 'topics';
    const LEFT_CONTEXT = 'lc';
    const RIGHT_CONTEXT = 'rc';
}

<?php

namespace YeTii\RhymeGenerator;

class RhymeOpt
{
    const MEANS_LIKE = 'ml';
    const SOUNDS_LIKE = 'sl';
    const SPELLED_LIKE = 'sp';
    const NOUNS_BY_ADJECTIVE = 'rel_jja';
    const ADJECTIVES_BY_NOUN = 'rel_jjb';
    const SYNONYMS_OF = 'rel_syn';
    const TRIGGERS_OF = 'rel_trg';
    const ANTONYMS_OF = 'rel_ant';
    const MORE_SPECIFIC_THAN = 'rel_spc';
    const MORE_GENERAL_THAN = 'rel_gen';
    const COMPRISES_OF = 'rel_com';
    const PART_OF = 'rel_par';
    const WORDS_FOLLOWING = 'rel_bga';
    const WORDS_PRECEDING = 'rel_bgb';
    const PERFECT_RHYMES = 'rel_rhy';
    const APPROX_RHYMES = 'rel_nry';
    const HOMOPHONES_OF = 'rel_hom';
    const MATCHES_CONSONANT = 'rel_cns';
    const OF_TOPIC = 'topics';
    const LEFT_CONTEXT = 'lc';
    const RIGHT_CONTEXT = 'rc';
}

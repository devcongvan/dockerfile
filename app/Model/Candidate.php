<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Candidate extends Model
{
    use ElasticquentTrait;

    protected $table = 'candidates';

    protected $fillable = [
        'can_name',
        'can_birthday',
        'can_gender',
        'can_avatar',
        'can_phone',
        'can_email',
        'hometown',
        'can_address',
        'can_skype',
        'can_facebook',
        'can_linkedin',
        'can_github',
        'can_source_id',
        'can_title',
        'can_year',
        'can_diary'
    ];

    protected $mappingProperties = array(
        "entity"          => [
            "properties" => [
                "name" => [
                    "type" => "text"
                ]
            ]
        ],
        "aggs_facets"     => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type" => "long"
                ]
            ]
        ],
        "text_facets"     => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type"   => "text",
                    "fields" => [
                        "keyword" => [
                            "type"         => "keyword",
                            "ignore_above" => 256
                        ]
                    ]
                ]
            ]
        ],
        "keyword_facets"  => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type" => "keyword"
                ]
            ]
        ],
        "long_facets"     => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type" => "long"
                ]
            ]
        ],
        "nested_facets"=>[
            "type"=>"nested",
            "properties"=>[
                "facet_name"=>[
                    "type"=>"keyword"
                ],
                "facet_value"=>[
                    "type"=>"nested"
                ]
            ]
        ],
        "date_facets"     => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type" => "date"
                ]
            ]
        ],
        "datetime_facets" => [
            "type"       => "nested",
            "properties" => [
                "facet_name"  => [
                    "type" => "keyword"
                ],
                "facet_value" => [
                    "type"   => "date",
                    "format" => "yyyy-MM-dd HH:mm:ss"
                ]
            ]
        ],
        "data"            => [
            "type" => "object"
        ]
    );

    function getIndexName()
    {
        return 'candidates';
    }

    function getTypeName()
    {
        return 'candidates';
    }

    public function candidateInfo()
    {
        return $this->hasOne(CandidateInfo::class, 'ci_candidates_id');
    }

    public function location()
    {
        return $this->belongsToMany(Location::class, 'workplaces', 'wp_candidates_id', 'wp_locations_id');
    }

    public function candidateCareer()
    {
        return $this->hasMany(CandidateCareer::class, 'cc_candidates_id');
    }

    public function career()
    {
        return $this->belongsToMany(Career::class, 'candidates_careers', 'cc_candidates_id', 'cc_careers_id');
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'candidates_skills', 'cs_candidates_id', 'cs_skills_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'can_source_id','id');
    }

    public function diary()
    {
        return $this->hasMany(Diary::class, 'd_can_id', 'id');
    }

    public function latest_diary()
    {
        return $this->hasOne(Diary::class, 'd_can_id', 'id')->orderBy('id', 'desc');
    }

    public function candidateType()
    {
        return $this->belongsToMany(CandidateType::class, 'diarys', 'd_can_id', 'd_cantype_id');
    }

}

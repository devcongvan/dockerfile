<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Candidate;

class ElasticController extends Controller
{
    public function createIndex(){
        Candidate::createIndex();

        $alert = [
            'type'    => 'success',
            'message' => 'Tạo Index thành công!'
        ];

        \Session::flash('toastr', $alert);

        return redirect()->route('candidate.list');
    }

    public function moveDataToElastic(){

        $candidate = Candidate::with(['candidateInfo', 'career:cc_careers_id,ca_name,ca_slug', 'skill:cs_skills_id,sk_name,sk_slug', 'latest_diary', 'source:id,so_name,so_slug', 'location:wp_locations_id,loc_name,loc_slug', 'candidateType' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->get();

        $can = new Candidate();
        foreach ($candidate as $key => $item)
        {
            $param = [
                "entity"          => ["name" => "candidates"],
                "text_facets"     => [
                    [
                        "facet_name"  => "can_name",
                        "facet_value" => $item->can_name
                    ],
                    [
                        "facet_name"  => "can_title",
                        "facet_value" => $item->can_title
                    ]
                ],
                "keyword_facets"  => [
                    [
                        "facet_name"  => "can_email",
                        "facet_value" => $item->can_email
                    ]
                ],
                "long_facets"     => [
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $item->can_source_id
                    ],
                    [
                        "facet_name"  => "can_year",
                        "facet_value" => $item->can_year
                    ],
                    [
                        "facet_name"  => "can_gender",
                        "facet_value" => $item->can_gender
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_type_of_work",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_type_of_work : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_english_level",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_english_level : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_qualification",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_qualification : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_time_experience",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_time_experience : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_from",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_salary_from : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_to",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_salary_to : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_evaluate",
                        "facet_value" => isset($item->latest_diary) ? $item->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_cantype_id",
                        "facet_value" => isset($item->latest_diary) ? $item->latest_diary->d_cantype_id : null
                    ]
                ],
                "nested_facets"   => [
                    [
                        "facet_name"  => "location",
                        "facet_value" => $item->location->toArray()
                    ],
                    [
                        "facet_name"  => "career",
                        "facet_value" => $item->career->toArray()
                    ],
                    [
                        "facet_name"  => "skill",
                        "facet_value" => $item->skill->toArray()
                    ],

                ],
                "date_facets"     => [
                    [
                        "facet_name"  => "can_birthday",
                        "facet_value" => $item->can_birthday
                    ]
                ],
                "datetime_facets" => [
                    [
                        "facet_name"  => "created_at",
                        "facet_value" => $item->created_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "updated_at",
                        "facet_value" => $item->updated_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "latest_diary.created_at",
                        "facet_value" => isset($item->latest_diary->created_at) ? $item->latest_diary->created_at->format('Y-m-d H:m:s') : null
                    ]
                ],
                "aggs_facets"     => [
                    [
                        "facet_name"  => "latest_diary_d_cantype_id",
                        "facet_value" => isset($item->latest_diary) ? $item->latest_diary->d_cantype_id : null
                    ],
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $item->can_source_id
                    ],
                    [
                        "facet_name"  => "latest_diary_d_evaluate",
                        "facet_value" => isset($item->latest_diary) ? $item->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "candidate_info_ci_type_of_work",
                        "facet_value" => isset($item->candidateInfo) ? $item->candidateInfo->ci_type_of_work : null
                    ]
                ],
                "data"            => $item

            ];
            $can->addDocToIndex($item->id, $param);
        }

        $alert = [
            'type'    => 'success',
            'message' => 'Chuyển dữ liệu từ Database sang Elasticsearch thành công!'
        ];

        \Session::flash('toastr', $alert);

        return redirect()->route('candidate.list');
    }

    public function updateADoc($id,$data){

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Candidate;
use App\Repositories\Eloquents\CandidateTagRepository;
use App\Repositories\Eloquents\CandidateRepository;

class ElasticController extends Controller
{
    protected $candidateTagRepository;
    protected $candidateRepository;

    public function __construct(CandidateTagRepository $candidateTagRepository,
                                CandidateRepository $candidateRepository)
    {
        $this->candidateTagRepository = $candidateTagRepository;
        $this->candidateRepository = $candidateRepository;
    }

    public function createIndex()
    {
        Candidate::createIndex();

        $alert = [
            'type'    => 'success',
            'message' => 'Tạo Index thành công!'
        ];

        \Session::flash('toastr', $alert);

        return redirect()->route('candidate.list');
    }

    public function reindex()
    {
        $can = new Candidate();
        $candidatesElastic = Candidate::searchByQuery([], [], [], 1100)->toArray();

        if (Candidate::typeExists())
        {

            Candidate::deleteIndex();

            Candidate::createIndex();

            foreach (array_chunk($candidatesElastic, 200) as $hi)
            {
                foreach ($hi as $ha)
                {
                    $can->addDocToIndex($ha['id'], $ha);
                }
            }

            $alert = [
                'type'    => 'success',
                'message' => 'Reindex thành công!'
            ];

            \Session::flash('toastr', $alert);

            return redirect()->route('candidate.list');
        }

    }

    public function moveDataToElastic()
    {
        $candidate_tags = config('candidate_options.candidate_tags');
        $with = array_merge(['candidateInfo', 'latest_diary', 'source:id,so_name,so_slug', 'candidateType' => function ($query) {
            $query->orderBy('id', 'desc');
        }], $candidate_tags);

        Candidate::with($with)->chunk(100, function ($candidate) {
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
                            "facet_name"  => "candidate_info-ci_type_of_work",
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

                foreach (config('candidate_options.candidate_tags') as $it)
                {
                    $param['nested_facets'][] = [
                        'facet_name'  => $it,
                        'facet_value' => $item->$it->toArray()
                    ];
                }

                $can->addDocToIndex($item->id, $param);
            }
        });

        $alert = [
            'type'    => 'success',
            'message' => 'Chuyển dữ liệu từ Database sang Elasticsearch thành công!'
        ];

        \Session::flash('toastr', $alert);

        return redirect()->route('candidate.list');
    }

    public function mapping()
    {
        $candidate=$this->candidateRepository->getById(5,['candidateInfo']);
        $candidateConfig = config('candidate_options.candidate_tags');

        $param=[];
        $firstFacade='';
        foreach ($candidateConfig as $key => $item){
            $explot= explode('|', $item);
            $chil='';
            if (count($explot)>2){
                list($facet, $attributeOrTable,$children) = $explot;
                $chil=$children;
            }else{
                list($facet, $attributeOrTable) = $explot;
            }

            if ($firstFacade != $facet)
            {
                $arr1 = [];
            }
            $arr1[]=[
                'facet_name'=>!empty($chil)?$attributeOrTable.'_'.$chil:$attributeOrTable,
                'facet_value'=>3
            ];
            $param[$facet] = $arr1;
            $firstFacade=$facet;

        }
//        $this->candidateTagRepository->insert($param);
//        $link='candidateInfo->ci_type_of_work';
        dump($param);
    }

    public function updateADoc($id, $data)
    {

    }
}

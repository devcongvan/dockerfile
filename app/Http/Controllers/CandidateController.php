<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest2;
use App\Model\Candidate;
use App\Repositories\Eloquents\CandidateCareerRepository;
use App\Repositories\Eloquents\CandidateInfoRepository;
use App\Repositories\Eloquents\CandidateRepository;
use App\Repositories\Eloquents\CandidateSkillRepository;
use App\Repositories\Eloquents\CandidateTypeRepository;
use App\Repositories\Eloquents\CareerRepository;
use App\Repositories\Eloquents\LocationRepository;
use App\Repositories\Eloquents\SourceRepository;

use App\Repositories\Eloquents\WorkplaceRepository;
use Illuminate\Http\Request;

use Elasticsearch\Client;

use App\Model\Location;
use App\Http\Requests\CandidateRequest;

use Maatwebsite\Excel;

class CandidateController extends Controller
{
    protected $candidateCareerRepository;
    protected $candidateSkillRepository;
    protected $workplaceRepository;

    protected $candidateRepository;
    protected $candidateinfoRepository;
    protected $sourceRepository;
    protected $locationRepository;
    protected $candidateTypeRepository;

    protected $careerRepository;

    protected $elasticsearch;

    public function __construct(CandidateRepository $candidateRepository,
                                SourceRepository $sourceRepository,
                                CandidateTypeRepository $candidateTypeRepository,
                                LocationRepository $locationRepository,
                                CareerRepository $careerRepository,
                                CandidateCareerRepository $candidateCareerRepository,
                                CandidateSkillRepository $candidateSkillRepository,
                                WorkplaceRepository $workplaceRepository,
                                CandidateInfoRepository $candidateInfoRepository)
    {
        $this->candidateRepository = $candidateRepository;
        $this->sourceRepository = $sourceRepository;
        $this->candidateTypeRepository = $candidateTypeRepository;
        $this->locationRepository = $locationRepository;
        $this->careerRepository = $careerRepository;
        $this->candidateCareerRepository = $candidateCareerRepository;
        $this->candidateSkillRepository = $candidateSkillRepository;
        $this->workplaceRepository = $workplaceRepository;
        $this->candidateinfoRepository = $candidateInfoRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $candidateTypes = $this->candidateTypeRepository->getAll();
        $sources = $this->sourceRepository->getAll();

        $cityCondition = [
            'columns' => ['id', 'loc_name'],
            'wheres'  => ['loc_parent_id' => 0]
        ];

        $typeOfWork = config('candidate_options.type_of_work');

        $englishLevel = config('candidate_options.english_level');

        $qualification = config('candidate_options.qualification');

        $time_experience = config('candidate_options.time_experiences');

        $data = [
            'candidateTypes' => $candidateTypes,
            'sources'        => $sources,
            'careers'        => $this->careerRepository->getAll(['columns' => ['id', 'ca_name']]),
            'city'           => $this->locationRepository->getAll($cityCondition),
            'typeOfWork'     => $typeOfWork,
            'englishLevel'   => $englishLevel,
            'qualification'  => $qualification,
            'timeExperience' => $time_experience,
        ];

        return view('candidate.index')->with($data);
    }

    public function searchAjax(Request $request)
    {

        $query = [];

        if (!empty($request->all()))
        {
            $query['bool']['filter'] = [];
        }

        // search name
        if (!empty($request->candidate_name))
        {
            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "text_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                ["term" => [
                                    "text_facets.facet_name" => [
                                        "value" => "can_name"
                                    ]
                                ]],
                                ["match_phrase_prefix" => [
                                    "text_facets.facet_value" => $request->get('candidate_name')
                                ]]
                            ]
                        ]
                    ]
                ]
            ];

        }

        // search title
        if (!empty($request->candidate_title))
        {

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "text_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "text_facets.facet_name" => [
                                            "value" => "can_title"
                                        ]
                                    ]],
                                [
                                    "match_phrase_prefix" => [
                                        "text_facets.facet_value" => $request->get('candidate_title')
                                    ]]
                            ]
                        ]
                    ]
                ]
            ];
        }

        $sort = [];

        if ((isset($request->candidate_status) && $request->candidate_status == 'ung_vien_moi'))
        {
            $sort = [
                "long_facets.facet_value" => [
                    "order"         => "desc",
                    "nested_path"   => "long_facets",
                    "nested_filter" => [
                        "term" => [
                            "long_facets.facet_name" => "can_id"]
                    ]
                ]
            ];
        }

        // search ứng viên mới cập nhật
        if ((isset($request->candidate_status) && $request->candidate_status == 'ung_vien_moi_cap_nhat'))
        {
            $sort = [
                "datetime_facets.facet_value" => [
                    "order"         => "desc",
                    "nested_path"   => "datetime_facets",
                    "nested_filter" => [
                        "term" => [
                            "datetime_facets.facet_name" => "updated_at"]
                    ]
                ]
            ];
        }

        // search loại ứng viên
        if (isset($request->candidate_type))
        {
            $query['bool']['filter'][] = [
                "bool" => [
                    "should" => [
                        [
                            "nested" => [
                                "path"  => "long_facets",
                                "query" => [
                                    "bool" => [
                                        "filter" => [
                                            [
                                                "term" => [
                                                    "long_facets.facet_name" => [
                                                        "value" => "latest_diary.d_cantype_id"
                                                    ]
                                                ]],
                                            [
                                                "terms" => [
                                                    "long_facets.facet_value" => $request->get('candidate_type')
                                                ]]
                                        ]
                                    ]
                                ]
                            ]]
                    ]
                ]
            ];

        };

        // search ứng viên theo thời gian viết nhật ký
        if (isset($request->diary_wrote))
        {
            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "datetime_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "datetime_facets.facet_name" => [
                                            "value" => "latest_diary.created_at"
                                        ]
                                    ]],
                                [
                                    "range" => [
                                        "datetime_facets.facet_value" => [
                                            "from"   => $request->get('diary_wrote'),
                                            "to"     => $request->get('diary_wrote'),
                                            "format" => "dd-MM-YYYY"
                                        ]]
                                ]
                            ]
                        ]]]
            ];
        }
        else if (isset($request->diary_wrote_from) || isset($request->diary_wrote_to))
        {

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "datetime_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "datetime_facets.facet_name" => [
                                            "value" => "latest_diary.created_at"
                                        ]
                                    ]],
                                [
                                    "range" => [
                                        "datetime_facets.facet_value" => [
                                            "from"   => isset($request->diary_wrote_from) ? $request->diary_wrote_from : 'now-20y/y',
                                            "to"     => isset($request->diary_wrote_to) ? $request->diary_wrote_to : 'now',
                                            "format" => "dd-MM-YYYY"
                                        ]]
                                ]
                            ]
                        ]]]
            ];
        }

        // search ứng viên theo nguồn
        if (isset($request->candidate_source))
        {

            $query['bool']['filter'][] = [
                "bool" => [
                    "should" => [
                        [
                            "nested" => [
                                "path"  => "long_facets",
                                "query" => [
                                    "bool" => [
                                        "filter" => [
                                            [
                                                "term" => [
                                                    "long_facets.facet_name" => [
                                                        "value" => "can_source_id"
                                                    ]
                                                ]],
                                            [
                                                "terms" => [
                                                    "long_facets.facet_value" => $request->get('candidate_source')
                                                ]]
                                        ]
                                    ]
                                ]
                            ]]
                    ]
                ]
            ];
        }

        // search ứng viên theo giới tính
        if (isset($request->gender))
        {
            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "long_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "long_facets.facet_name" => [
                                            "value" => "can_gender"
                                        ]
                                    ]],
                                [
                                    "term" => [
                                        "long_facets.facet_value" => [
                                            "value" => $request->get('gender')
                                        ]]
                                ]
                            ]
                        ]]]
            ];
        }

        // search range age
        if (isset($request->range_age) && $request->get('range_age') !== '0,100')
        {
            $ages = explode(',', $request->get('range_age'));

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "date_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "date_facets.facet_name" => [
                                            "value" => "can_birthday"
                                        ]
                                    ]],
                                [
                                    "range" => [
                                        "date_facets.facet_value" => [
                                            "gte" => !empty($ages[1]) ? (date('Y') - $ages[1]) . "-01-01" : "1930-01-01",
                                            "lte" => !empty($ages[0]) ? (date('Y') - $ages[0]) . "-12-30" : date('Y') . "-12-30"
                                        ]]
                                ]
                            ]
                        ]]]
            ];

        }

        // search loại hình công việc
        if (isset($request->type_of_work))
        {

            $query['bool']['filter'][] = [
                "bool" => [
                    "should" => [
                        [
                            "nested" => [
                                "path"  => "long_facets",
                                "query" => [
                                    "bool" => [
                                        "filter" => [
                                            [
                                                "term" => [
                                                    "long_facets.facet_name" => [
                                                        "value" => "candidate_info.ci_type_of_work"
                                                    ]
                                                ]],
                                            [
                                                "terms" => [
                                                    "long_facets.facet_value" => $request->get('type_of_work')
                                                ]]
                                        ]
                                    ]
                                ]
                            ]]
                    ]
                ]
            ];
        }

        // search theo tình độ ngọi ngữ
        if (isset($request->english_level))
        {

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "long_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "long_facets.facet_name" => [
                                            "value" => "candidate_info.ci_english_level"
                                        ]
                                    ]],
                                [
                                    "term" => [
                                        "long_facets.facet_value" => [
                                            "value" => $request->get('english_level')
                                        ]]
                                ]
                            ]
                        ]]]
            ];

        }

        // search trình độ chuyên môn
        if (isset($request->qualification))
        {

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "long_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "long_facets.facet_name" => [
                                            "value" => "candidate_info.ci_qualification"
                                        ]
                                    ]],
                                [
                                    "term" => [
                                        "long_facets.facet_value" => [
                                            "value" => $request->get('qualification')
                                        ]]
                                ]
                            ]
                        ]]]
            ];

        }

        // search thời gian làm việc
        if (isset($request->time_experience))
        {

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "long_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "long_facets.facet_name" => [
                                            "value" => "candidate_info.ci_time_experience"
                                        ]
                                    ]],
                                [
                                    "term" => [
                                        "long_facets.facet_value" => [
                                            "value" => $request->get('time_experience')
                                        ]]
                                ]
                            ]
                        ]]]
            ];

        }

        // search theo mức lương
        if (isset($request->salary))
        {
            if ($request->get('salary')!=='0,100'){
                $arrSalary = explode(',', $request->get('salary'));

                $query['bool']['filter'][] = [
                    ["nested" => [
                        "path"  => "long_facets",
                        "query" => [
                            "bool" => [
                                "filter" => [
                                    [
                                        "term" => [
                                            "long_facets.facet_name" => [
                                                "value" => "candidate_info.ci_salary_from"
                                            ]
                                        ]],
                                    [
                                        "range" => [
                                            "long_facets.facet_value" => [
                                                "gte" => $arrSalary[0]
                                            ]]
                                    ]
                                ]
                            ]]]],
                    ["nested" => [
                        "path"  => "long_facets",
                        "query" => [
                            "bool" => [
                                "filter" => [
                                    [
                                        "term" => [
                                            "long_facets.facet_name" => [
                                                "value" => "candidate_info.ci_salary_to"
                                            ]
                                        ]],
                                    [
                                        "range" => [
                                            "long_facets.facet_value" => [
                                                "lte" => $arrSalary[1]
                                            ]]
                                    ]
                                ]
                            ]]]]
                ];
            }

        }

        // search theo đánh giá
        if (isset($request->candidate_rate))
        {

            $query['bool']['filter'][] = [
                "bool" => [
                    "should" => [
                        [
                            "nested" => [
                                "path"  => "long_facets",
                                "query" => [
                                    "bool" => [
                                        "filter" => [
                                            [
                                                "term" => [
                                                    "long_facets.facet_name" => [
                                                        "value" => "latest_diary.d_evaluate"
                                                    ]
                                                ]],
                                            [
                                                "terms" => [
                                                    "long_facets.facet_value" => $request->get('candidate_rate')
                                                ]]
                                        ]
                                    ]
                                ]
                            ]]
                    ]
                ]
            ];

        }

        // search ứng viên theo địa điểm mong muốn làm việc
        if (isset($request->city))
        {
            $citys = $request->get('city');
            if (!empty($citys[0]))
            {
                $cityId = [];
                foreach ($citys as $item)
                {
                    $cityId[] = preg_replace('/[^0-9]/', '', $item);
                }

                $query['bool']['filter'][] = [
                    "nested" => [
                        "path"  => "nested_facets",
                        "query" => [
                            "bool" => [
                                "filter" => [
                                    [
                                        "term" => [
                                            "nested_facets.facet_name" => [
                                                "value" => "location"
                                            ]
                                        ]],
                                    [
                                        "nested" => [
                                            "path"  => "nested_facets.facet_value",
                                            "query" => [
                                                "terms" => [
                                                    "nested_facets.facet_value.wp_locations_id" => $cityId
                                                ]
                                            ]
                                        ]]
                                ]
                            ]
                        ]
                    ]
                ];
            }
        }

        // search ứng viên theo ngành nghề
        if (isset($request->career))
        {
            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "nested_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "nested_facets.facet_name" => [
                                            "value" => "career"
                                        ]
                                    ]],
                                [
                                    "nested" => [
                                        "path"  => "nested_facets.facet_value",
                                        "query" => [
                                            "terms" => [
                                                "nested_facets.facet_value.cc_careers_id" => $request->get('career')
                                            ]
                                        ]
                                    ]]
                            ]
                        ]
                    ]
                ]
            ];
        }

        // search ứng viên theo ngành nghề
        if (isset($request->skill))
        {
            $skills = $request->get('skill');
            $skillId = [];
            foreach ($skills as $item)
            {
                $skillId[] = preg_replace('/[^0-9]/', '', $item);
            }

            $query['bool']['filter'][] = [
                "nested" => [
                    "path"  => "nested_facets",
                    "query" => [
                        "bool" => [
                            "filter" => [
                                [
                                    "term" => [
                                        "nested_facets.facet_name" => [
                                            "value" => "skill"
                                        ]
                                    ]],
                                [
                                    "nested" => [
                                        "path"  => "nested_facets.facet_value",
                                        "query" => [
                                            "terms" => [
                                                "nested_facets.facet_value.cs_skills_id" => $skillId
                                            ]
                                        ]
                                    ]]
                            ]
                        ]
                    ]
                ]
            ];
        }

        $total_doc = Candidate::searchByQuery($query, [], [], 0)->totalHits();

        $limit = !empty($request->limit) ? $request->get('limit') : 15;

        $totalPage = ceil($total_doc / $limit);

        $page = !empty($request->page) ? $request->get('page') : 0;

        $offset = ($page - 1) * $limit;

        // aggregations
        $aggregations = [
            "aggs_facets" => [
                "nested" => [
                    "path" => "aggs_facets"
                ],
                "aggs"   => [
                    "facet_name" => [
                        "terms" => [
                            "field" => "aggs_facets.facet_name",
                            "size"  => "20"
                        ],
                        "aggs"  => [
                            "facet_value" => [
                                "terms" => [
                                    "field" => "aggs_facets.facet_value",
                                    "order" => ["_key" => "asc"],
                                    "size"  => "20"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        // all candidates on Elasticsearch
        $candidates = Candidate::searchByQuery($query, $aggregations, [], $limit, $offset, $sort);

        // aggregation
        $arrAggregations = $candidates->getAggregations()['aggs_facets']['facet_name']['buckets'];
        $arrAggregationsPluck = array_pluck($arrAggregations, 'key');
        $newArrAggregations = [];
        foreach ($arrAggregationsPluck as $key => $item)
        {
            $newArrAggregations[$item] = $arrAggregations[$key]['facet_value']['buckets'];
        }

        $data = [
            'request'     => $request->all(),
            'candidates'  => $candidates,
            'paginate'    => [
                'total'     => $total_doc,
                'first'     => $offset + 1,
                'last'      => ($offset + $limit) > $total_doc ? $total_doc : $offset + $limit,
                'totalPage' => $totalPage
            ],
            'aggerations' => $newArrAggregations,
        ];

        return response($data);
    }

    public function store()
    {

        $cityCondition = [
            'columns' => ['id', 'loc_name'],
            'wheres'  => ['loc_parent_id' => 0]
        ];

        $data = [
            'careers'         => $this->careerRepository->getAll(['columns' => ['id', 'ca_name']]),
            'sources'         => $this->sourceRepository->getAll(['columns' => ['id', 'so_name']]),
            'city'            => $this->locationRepository->getAll($cityCondition),
            'time_experience' => config('candidate_options.time_experience'),
            'qualification'   => config('candidate_options.qualification'),
            'english_level'   => config('candidate_options.english_level'),
            'type_of_work'    => config('candidate_options.type_of_work'),
            'salary'          => config('candidate_options.salary')
        ];

        return view('candidate.add')->with($data);
    }

    public function postStore(CandidateRequest2 $request)
    {
        if ($request->has('can_phone') && $request->has('can_email'))
        {
            $condidtion = [
                'count'  => true,
                'wheres' => [
                    ['can_phone', '=', $request->can_phone],
                    ['can_email', '=', $request->can_email]
                ]
            ];
            $count = $this->candidateRepository->getAll($condidtion);
            if ($count > 0)
            {
                return back()->with('email_phone_error', 'Email và điện thoại đã tồn tại!')->withInput();
            }
        }

        if ($experiences = $request->get('ci_work_experience_company'))
        {
            $ci_work_experience = [];
            foreach ($experiences as $index => $item)
            {
                $ci_work_experience[] = [
                    'company'  => strip_tags($item),
                    'start'    => strip_tags($request->get('ci_work_experience_start')[$index]),
                    'finish'   => strip_tags($request->get('ci_work_experience_finish')[$index]),
                    'time'     => strip_tags($request->get('ci_work_experience_time')[$index]),
                    'position' => strip_tags($request->get('ci_work_experience_position')[$index]),
                    'process'  => strip_tags($request->get('ci_work_experience_process')[$index]),
                ];
            }
        }

        if ($educations = $request->get('ci_education_name'))
        {
            $ci_education = [];
            foreach ($educations as $index => $item)
            {
                $ci_education[] = [
                    'schoolname' => strip_tags($item),
                    'start'      => strip_tags($request->get('ci_education_start')[$index]),
                    'finish'     => strip_tags($request->get('ci_education_finish')[$index]),
                    'faculty'    => strip_tags($request->get('ci_education_faculty')[$index]),
                    'process'    => strip_tags($request->get('ci_education_process')[$index]),
                ];
            }
        }

        if ($activitys = $request->get('ci_activity_name'))
        {
            $ci_activity = [];
            foreach ($activitys as $index => $item)
            {
                $ci_activity[] = [
                    'name'     => strip_tags($item),
                    'start'    => strip_tags($request->get('ci_activity_start')[$index]),
                    'finish'   => strip_tags($request->get('ci_activity_finish')[$index]),
                    'position' => strip_tags($request->get('ci_activity_position')[$index]),
                    'process'  => strip_tags($request->get('ci_activity_process')[$index]),
                ];
            }
        }

        if ($certificates = $request->get('ci_certificate_time'))
        {
            $ci_certificate = [];

            foreach ($certificates as $index => $item)
            {
                $ci_certificate[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_certificate_name')[$index]),
                ];
            }
        }

        if ($prizes = $request->get('ci_prize_time'))
        {
            $ci_prize = [];

            foreach ($prizes as $index => $item)
            {
                $ci_prize[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_prize_name')[$index]),
                ];
            }
        }

        if ($skills = $request->get('ci_skill_name'))
        {
            $ci_skill = [];
            foreach ($skills as $index => $item)
            {
                $ci_skill[] = [
                    'name'     => strip_tags($item),
                    'evaluate' => strip_tags($request->get('ci_skill_evaluate')[$index]),
                ];
            }
        }

        $arrCandidate = [
            'can_name'      => strip_tags($request->get('can_name')),
            'can_gender'    => strip_tags($request->get('can_gender')),
            'can_phone'     => strip_tags($request->get('can_phone')),
            'can_email'     => strip_tags($request->get('can_email')),
            'hometown'      => strip_tags($request->get('hometown')),
            'can_address'   => strip_tags($request->get('can_address')),
            'can_skype'     => strip_tags($request->get('can_skype')),
            'can_facebook'  => strip_tags($request->get('can_facebook')),
            'can_linkedin'  => strip_tags($request->get('can_linkedin')),
            'can_github'    => strip_tags($request->get('can_github')),
            'can_source_id' => strip_tags($request->get('can_source_id')),
            'can_title'     => strip_tags($request->get('can_title')),
            'can_year'      => strip_tags($request->get('can_year'))
        ];

        if (!empty($request->get('can_birthday')))
        {
            $arrCandidate['can_birthday'] = date("Y-m-d", strtotime($request->get('can_birthday')));

        }
        else
        {
            $arrCandidate['can_birthday'] = null;
        }

        if ($request->hasFile('avatar'))
        {
            $file = $request->avatar;
            $path = public_path('upload/avatar/');

            $file_name = rand() . '_' . $file->getClientOriginalName();

            if ($file->move($path, $file_name))
            {
                $arrCandidate['can_avatar'] = '/upload/avatar/' . $file_name;
            }
            else
            {
                $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
            }
        }
        else
        {
            $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
        }

        $lastCandidateId = $this->candidateRepository->create($arrCandidate)->id;

        if ($salarys = $request->get('ci_salary'))
        {
            $arrSalary = explode('|', $salarys);
        }

        $arrCandidateInfo = [
            'ci_candidates_id'   => $lastCandidateId,
            'ci_work_abroad'     => strip_tags($request->get('ci_work_abroad')),
            'ci_time_experience' => strip_tags($request->get('ci_time_experience')),
            'ci_qualification'   => strip_tags($request->get('ci_qualification')),
            'ci_english_level'   => strip_tags($request->get('ci_english_level')),
            'ci_type_of_work'    => strip_tags($request->get('ci_type_of_work')),
            'ci_salary'          => strip_tags($request->get('ci_salary')),
            'ci_target'          => strip_tags($request->get('ci_target')),
            'ci_about'           => strip_tags($request->get('ci_about')),
            'ci_work_experience' => json_encode($ci_work_experience),
            'ci_education'       => json_encode($ci_education),
            'ci_activity'        => json_encode($ci_activity),
            'ci_certificate'     => json_encode($ci_certificate),
            'ci_prize'           => json_encode($ci_prize),
            'ci_skill'           => json_encode($ci_skill),
            'ci_hobby'           => strip_tags($request->get('ci_hobby')),
            'ci_salary_from' => isset($arrSalary) ? $arrSalary[1] : 0,
            'ci_salary_to'   => isset($arrSalary) ? $arrSalary[2] : 0
        ];

        if ($careers = $request->get('career'))
        {
            $arrCandidateCareer = [];
            foreach ($careers as $item)
            {
                $arrCandidateCareer[] = [
                    'cc_candidates_id' => $lastCandidateId,
                    'cc_careers_id'    => $item
                ];
            }
            $this->candidateCareerRepository->insert($arrCandidateCareer);
        }

        if ($skills = $request->get('skill'))
        {
            $arrCandidateSkill = [];
            foreach ($skills as $item)
            {
                $idSkill = preg_replace('/[^0-9]/', '', $item);
                $arrCandidateSkill[] = [
                    'cs_candidates_id' => $lastCandidateId,
                    'cs_skills_id'     => $idSkill
                ];
            }
            $this->candidateSkillRepository->insert($arrCandidateSkill);
        }

        if ($city = $request->get('city'))
        {
            dd($city);
            $idCity = preg_replace('/[^0-9]/', '', $city);
            $arrWorkplace[] = [
                'wp_candidates_id' => $lastCandidateId,
                'wp_locations_id'  => $idCity
            ];
            if ($districts = $request->get('district'))
            {
                foreach ($districts as $item)
                {
                    $arrWorkplace[] = [
                        'wp_candidates_id' => $lastCandidateId,
                        'wp_locations_id'  => preg_replace('/[^0-9]/', '', $item)
                    ];
                }
            }

            $this->workplaceRepository->insert($arrWorkplace);
        }

        if ($this->candidateinfoRepository->create($arrCandidateInfo))
        {
            $candidate = $this->candidateRepository->getOneByElastic($lastCandidateId);

            $param = [
                "entity"          => ["name" => "candidates"],
                "text_facets"     => [
                    [
                        "facet_name"  => "can_name",
                        "facet_value" => $candidate->can_name
                    ],
                    [
                        "facet_name"  => "can_title",
                        "facet_value" => $candidate->can_title
                    ]
                ],
                "keyword_facets"  => [
                    [
                        "facet_name"  => "can_email",
                        "facet_value" => $candidate->can_email
                    ]
                ],
                "long_facets"     => [
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $candidate->can_source_id
                    ],
                    [
                        "facet_name"  => "can_year",
                        "facet_value" => $candidate->can_year
                    ],
                    [
                        "facet_name"  => "can_gender",
                        "facet_value" => $candidate->can_gender
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_type_of_work",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_type_of_work : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_english_level",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_english_level : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_qualification",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_qualification : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_time_experience",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_time_experience : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_from",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_salary_from : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_to",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_salary_to : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_evaluate",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_cantype_id",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_cantype_id : null
                    ]
                ],
                "nested_facets"   => [
                    [
                        "facet_name"  => "location",
                        "facet_value" => $candidate->location->toArray()
                    ],
                    [
                        "facet_name"  => "career",
                        "facet_value" => $candidate->career->toArray()
                    ],
                    [
                        "facet_name"  => "skill",
                        "facet_value" => $candidate->skill->toArray()
                    ],

                ],
                "date_facets"     => [
                    [
                        "facet_name"  => "can_birthday",
                        "facet_value" => $candidate->can_birthday
                    ]
                ],
                "datetime_facets" => [
                    [
                        "facet_name"  => "created_at",
                        "facet_value" => $candidate->created_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "updated_at",
                        "facet_value" => $candidate->updated_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "latest_diary.created_at",
                        "facet_value" => isset($candidate->latest_diary->created_at) ? $candidate->latest_diary->created_at->format('Y-m-d H:m:s') : null
                    ]
                ],
                "aggs_facets"     => [
                    [
                        "facet_name"  => "latest_diary_d_cantype_id",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_cantype_id : null
                    ],
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $candidate->can_source_id
                    ],
                    [
                        "facet_name"  => "latest_diary_d_evaluate",
                        "facet_value" => isset($item->latest_diary) ? $candidate->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "candidate_info_ci_type_of_work",
                        "facet_value" => isset($item->candidateInfo) ? $candidate->candidateInfo->ci_type_of_work : null
                    ]
                ],
                "data"            => $candidate

            ];

            $can = new Candidate();
            $can->addDocToIndex($lastCandidateId, $param);

            $alert = [
                'type'    => 'success',
                'message' => 'Đã thêm ứng viên!'
            ];

            \Session::flash('toastr', $alert);

            return redirect('candidate/list');

        }

        return redirect('candidate/new');

    }

    public function importExcel(Request $request)
    {
//        dd($request->hasFile('file'));

        if ($request->hasFile('file'))
        {

            $path = $request->file('file')->getRealPath();

            $excelData = '';
            \Excel::load($path, function ($reader) {

                $excelData = $reader->toArray();

                $this->changeField($excelData);

            });
        }

        $notification = [
            'message'    => 'Thêm ứng viên từ File Excel thành công!',
            'alert-type' => 'success'
        ];

        return redirect('candidate/list')->with($notification);
    }

    public function changeField(array $data)
    {
        $candidate_field = config('candidate_options.candidate_field.candidates');

        $insert = [];

        foreach ($data as $item)
        {
            $subItem = [];
            if (empty($item['ho_ten_uv']))
            {
                continue;
            }

            $subItem['candidates_careers'] = [];
            $subItem['ci_experience']['companys'] = [];
            $subItem['ci_experience']['start'] = [];
            $subItem['ci_experience']['finish'] = [];
            $subItem['ci_experience']['time'] = [];
            $subItem['ci_experience']['position'] = [];
            $subItem['ci_experience']['process'] = [];
            $subItem['about'] = [];
            foreach ($item as $key => $value)
            {
                if (!empty($candidate_field[$key]))
                {
                    $subItem[$candidate_field[$key]] = $value;
                }
                else
                {
                    if (strrpos($key, 'nganh_nghe_') > -1 && !empty($value))
                    {
                        $subItem['candidates_careers'][] = $item[$key];
                    }

                    if (strrpos($key, 'cong_ty_') > -1 && !empty($value))
                    {
                        $subItem['ci_experience']['companys'][] = $item[$key];
                    }

                    if (strrpos($key, 'thoi_gian_lam_viec_') > -1 && !empty($value))
                    {
                        $subItem['ci_experience']['time'][] = $item[$key];
                    }

                    if (strrpos($key, 'cap_bac_') > -1 && !empty($value))
                    {
                        $subItem['ci_experience']['position'][] = $item[$key];
                    }

                    if (strrpos($key, 'chuyen_mon_') > -1 && !empty($value))
                    {
                        $subItem['ci_experience']['process'][] = $item[$key];
                    }
                }
            }

            $insert[] = $subItem;
        }

        if (!empty($insert))
        {
            $this->insertExcelToDatabase($insert);
        }
        else
        {
            return redirect();
        }
    }

    public function insertExcelToDatabase(array $data)
    {

        foreach ($data as $key => $item)
        {
            if (empty($item['can_name']))
            {
                continue;
            }
            if (!empty($item['can_email']))
            {
                if (count($this->candidateRepository->getAll(['columns' => 'id', 'wheres' => ['can_name' => $item['can_name'], 'can_email' => $item['can_email']]])) > 0)
                {
                    continue;
                }
            }
//            Đã lấy được candidate
            $candidate = [
                'can_name'     => strip_tags(!empty($item['can_name']) ? $item['can_name'] : ''),
                'can_year'     => strip_tags(str_replace(".0", "", !empty($item['can_year']) ? $item['can_year'] : '')),
                'can_phone'    => strip_tags(!empty($item['can_phone']) ? $item['can_phone'] : ''),
                'can_email'    => strip_tags(!empty($item['can_email']) ? $item['can_email'] : ''),
                'can_facebook' => strip_tags(!empty($item['can_facebook']) ? $item['can_facebook'] : ''),
                'can_title'    => strip_tags(!empty($item['can_title']) ? $item['can_title'] : ''),
            ];

            if ($lastCandidateId = $this->candidateRepository->create($candidate))
            {
                if (!empty($item['candidates_careers']))
                {
                    foreach ($item['candidates_careers'] as $candidates_careers_key => $candidates_career_item)
                    {
                        if ($career = $this->careerRepository->getAll(['columns' => ['id', 'ca_name'], 'where' => ['ca_name' => $candidates_career_item]])->first())
                        {

                            $arrCandidateCareer1 = [
                                'cc_candidates_id' => $lastCandidateId,
                                'cc_careers_id'    => $career->id,
                            ];
                            $this->candidateCareerRepository->create($arrCandidateCareer1);
                        }
                        else
                        {
                            if ($career_id = $this->careerRepository->create(['ca_name' => $candidates_career_item]))
                            {

                                $arrCandidateCareer2 = [
                                    'cc_candidates_id' => $lastCandidateId,
                                    'cc_careers_id'    => $career_id
                                ];
                                $this->candidateCareerRepository->create($arrCandidateCareer2);
                            }
                        }
                    }
                }

                if (!empty($item['ci_experience']))
                {
                    $candidate_info['ci_candidates_id'] = $lastCandidateId;

                    $candidate_info['ci_experience'] = '';

                    if (!empty($item['ci_experience']))
                    {
                        $jsonArray = [];
                        foreach ($item['ci_experience']['companys'] as $ci_experience_key => $ci_experience_item)
                        {
                            $jsonArray = [
                                "company"  => $ci_experience_item,
                                "start"    => !empty($item['ci_experience']['start'][$ci_experience_key]) ? $item['ci_experience']['start'][$ci_experience_key] : '',
                                "finish"   => !empty($item['ci_experience']['finish'][$ci_experience_key]) ? $item['ci_experience']['finish'][$ci_experience_key] : '',
                                "time"     => !empty($item['ci_experience']['time'][$ci_experience_key]) ? $item['ci_experience']['time'][$ci_experience_key] : '',
                                "position" => !empty($item['ci_experience']['position'][$ci_experience_key]) ? $item['ci_experience']['position'][$ci_experience_key] : '',
                                "process"  => !empty($item['ci_experience']['process'][$ci_experience_key]) ? $item['ci_experience']['process'][$ci_experience_key] : ''
                            ];
                        }
                        $candidate_info['ci_work_experience'] = json_encode($jsonArray);
                    }
                }

                $candidate_info['ci_about'] = '';

                foreach ($item as $about_key => $about)
                {
                    if (strrpos($about_key, 'ci_about_') > -1 && !empty($about))
                    {
                        $candidate_info['ci_about'] .= ' ' . $about;
                    }
                }
                $this->candidateinfoRepository->create($candidate_info);
            }
        }

        $notification = [
            'message'    => 'Thêm ứng viên từ File Excel thành công!',
            'alert-type' => 'success'
        ];

        return redirect('candidate/list')->with($notification);
    }

    public function actionSource($source)
    {
        if (!is_numeric($source))
        {
            if ($sourceID = $this->sourceRepository->getAll(['columns' => 'id', 'search' => ['field' => 'so_name', 'string' => $source]]))
            {
                dd($sourceID);
            }
        }
    }

    public function update($id)
    {

        $cityCondition = [
            'columns' => ['id', 'loc_name'],
            'wheres'  => ['loc_parent_id' => 0]
        ];
        $data = [
            'careers'   => $this->careerRepository->getAll(['columns' => ['id', 'ca_name']]),
            'sources'   => $this->sourceRepository->getAll(['columns' => ['id', 'so_name']]),
            'candidate' => $this->candidateRepository->getById($id, ['candidateInfo', 'career:cc_careers_id,ca_name',
                'skill:cs_skills_id,sk_name', 'location:wp_locations_id,loc_name'
            ]),
            'city'      => $this->locationRepository->getAll($cityCondition),

            'time_experience' => config('candidate_options.time_experience'),
            'qualification'   => config('candidate_options.qualification'),
            'english_level'   => config('candidate_options.english_level'),
            'type_of_work'    => config('candidate_options.type_of_work'),
            'salary'          => config('candidate_options.salary')

        ];

        if (!empty($data['candidate']->location->first()))
        {
            $data['idCity'] = $data['candidate']->location->first()->id;
        }

        if ($dataInfo = $data['candidate']->candidateInfo)
        {

            if ($exp = $dataInfo->ci_work_experience)
            {
                $data['candidate']->candidateInfo->ci_work_experience = json_decode($exp);
            }

            if ($edu = $dataInfo->ci_education)
            {
                $data['candidate']->candidateInfo->ci_education = json_decode($edu);
            }

            if ($activity = $dataInfo->ci_activity)
            {
                $data['candidate']->candidateInfo->ci_activity = json_decode($activity);
            }

            if ($certificate = $dataInfo->ci_certificate)
            {
                $data['candidate']->candidateInfo->ci_certificate = json_decode($certificate);
            }

            if ($prize = $dataInfo->ci_prize)
            {
                $data['candidate']->candidateInfo->ci_prize = json_decode($prize);
            }

            if ($skill = $dataInfo->ci_skill)
            {
                $data['candidate']->candidateInfo->ci_skill = json_decode($skill);
            }

        }

//        dd($data['candidate']->candidateInfo);
        return view('candidate.add')->with($data);
    }

    public function updatePost(CandidateRequest2 $request)
    {
        if ($request->has('can_phone') && $request->has('can_email'))
        {
            $condidtion = [
                'count'  => true,
                'wheres' => [
                    ['can_phone', '=', $request->get('can_phone')],
                    ['can_email', '=', $request->get('can_email')],
                    ['id', '<>', $request->get('candidate_id')]
                ]
            ];
            $count = $this->candidateRepository->getAll($condidtion);
            if ($count > 0)
            {
                return back()->with('email_phone_error', 'Email và điện thoại đã tồn tại!')->withInput();
            }
        }
        if ($experiences = $request->get('ci_work_experience_company'))
        {
            $ci_work_experience = [];
            foreach ($experiences as $index => $item)
            {
                $ci_work_experience[] = [
                    'company'  => strip_tags($item),
                    'start'    => strip_tags($request->get('ci_work_experience_start')[$index]),
                    'finish'   => strip_tags($request->get('ci_work_experience_finish')[$index]),
                    'position' => strip_tags($request->get('ci_work_experience_position')[$index]),
                    'process'  => strip_tags($request->get('ci_work_experience_process')[$index]),
                ];
            }
        }

        if ($educations = $request->get('ci_education_name'))
        {
            $ci_education = [];
            foreach ($educations as $index => $item)
            {
                $ci_education[] = [
                    'schoolname' => strip_tags($item),
                    'start'      => strip_tags($request->get('ci_education_start')[$index]),
                    'finish'     => strip_tags($request->get('ci_education_finish')[$index]),
                    'faculty'    => strip_tags($request->get('ci_education_faculty')[$index]),
                    'process'    => strip_tags($request->get('ci_education_process')[$index]),
                ];
            }
        }

        if ($activitys = $request->get('ci_activity_name'))
        {
            $ci_activity = [];
            foreach ($activitys as $index => $item)
            {
                $ci_activity[] = [
                    'name'     => strip_tags($item),
                    'start'    => strip_tags($request->get('ci_activity_start')[$index]),
                    'finish'   => strip_tags($request->get('ci_activity_finish')[$index]),
                    'position' => strip_tags($request->get('ci_activity_position')[$index]),
                    'process'  => strip_tags($request->get('ci_activity_process')[$index]),
                ];
            }
        }

        if ($certificates = $request->get('ci_certificate_time'))
        {
            $ci_certificate = [];

            foreach ($certificates as $index => $item)
            {
                $ci_certificate[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_certificate_name')[$index]),
                ];
            }
        }

        if ($prizes = $request->get('ci_prize_time'))
        {
            $ci_prize = [];

            foreach ($prizes as $index => $item)
            {
                $ci_prize[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_prize_name')[$index]),
                ];
            }
        }

        if ($skills = $request->get('ci_skill_name'))
        {
            $ci_skill = [];
            foreach ($skills as $index => $item)
            {
                $ci_skill[] = [
                    'name'     => strip_tags($item),
                    'evaluate' => strip_tags($request->get('ci_skill_evaluate')[$index]),
                ];
            }
        }

        $arrCandidate = [
            'can_name'      => strip_tags($request->get('can_name')),
            'can_birthday'  => strip_tags(date("Y-m-d", strtotime($request->get('can_birthday')))),
            'can_gender'    => strip_tags($request->get('can_gender')),
            'can_phone'     => strip_tags($request->get('can_phone')),
            'can_email'     => strip_tags($request->get('can_email')),
            'hometown'      => strip_tags($request->get('hometown')),
            'can_address'   => strip_tags($request->get('can_address')),
            'can_skype'     => strip_tags($request->get('can_skype')),
            'can_facebook'  => strip_tags($request->get('can_facebook')),
            'can_linkedin'  => strip_tags($request->get('can_linkedin')),
            'can_github'    => strip_tags($request->get('can_github')),
            'can_source_id' => strip_tags($request->get('can_source_id')),
            'can_title'     => strip_tags($request->get('can_title')),
        ];

        if ($request->hasFile('avatar'))
        {
            $file = $request->avatar;
            $path = public_path('upload/avatar/');

            $old_file = public_path($request->get('old_avatar'));

            if (file_exists($old_file))
            {
                unlink($old_file);
            }

            $file_name = rand() . '_' . $file->getClientOriginalName();

            if ($file->move($path, $file_name))
            {
                $arrCandidate['can_avatar'] = '/upload/avatar/' . $file_name;
            }
            else
            {
                $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
            }
        }

        if ($idCandidate = $request->get('candidate_id'))
        {
            $this->candidateRepository->update($idCandidate, $arrCandidate);
            $this->workplaceRepository->deleteByCandidateId($idCandidate, 'wp_candidates_id');
            $this->candidateCareerRepository->deleteByCandidateId($idCandidate, 'cc_candidates_id');
            $this->candidateSkillRepository->deleteByCandidateId($idCandidate, 'cs_candidates_id');
        }

        if ($salarys=$request->get('ci_salary')){
            $arrSalary=explode('|', $salarys);
        }

        $arrCandidateInfo = [
            'ci_candidates_id'   => $idCandidate,
            'ci_work_abroad'     => strip_tags($request->get('ci_work_abroad')),
            'ci_time_experience' => strip_tags($request->get('ci_time_experience')),
            'ci_qualification'   => strip_tags($request->get('ci_qualification')),
            'ci_english_level'   => strip_tags($request->get('ci_english_level')),
            'ci_type_of_work'    => strip_tags($request->get('ci_type_of_work')),
            'ci_salary'          => isset($arrSalary)?$arrSalary[0]:0,
            'ci_target'          => strip_tags($request->get('ci_target')),
            'ci_about'           => strip_tags($request->get('ci_about')),
            'ci_work_experience' => json_encode($ci_work_experience),
            'ci_education'       => json_encode($ci_education),
            'ci_activity'        => json_encode($ci_activity),
            'ci_certificate'     => json_encode($ci_certificate),
            'ci_prize'           => json_encode($ci_prize),
            'ci_skill'           => json_encode($ci_skill),
            'ci_hobby'           => strip_tags($request->get('ci_hobby')),
            'ci_salary_from' => isset($arrSalary) ? $arrSalary[1] : 0,
            'ci_salary_to'   => isset($arrSalary) ? $arrSalary[2] : 0
        ];

        if ($idCandidateInfo = $request->get('candidateInfo_id'))
        {
            $this->candidateinfoRepository->update($idCandidateInfo, $arrCandidateInfo);
        }

        if ($careers = $request->get('career'))
        {
            $arrCandidateCareer = [];

            foreach ($careers as $item)
            {
                $arrCandidateCareer[] = [
                    'cc_candidates_id' => $idCandidate,
                    'cc_careers_id'    => $item
                ];
            }
            $this->candidateCareerRepository->insert($arrCandidateCareer);

        }

        if ($skills = $request->get('skill'))
        {
            $arrCandidateSkill = [];
            foreach ($skills as $item)
            {
                $idSkill = preg_replace('/[^0-9]/', '', $item);
                $arrCandidateSkill[] = [
                    'cs_candidates_id' => $idCandidate,
                    'cs_skills_id'     => $idSkill
                ];
            }
            $this->candidateSkillRepository->insert($arrCandidateSkill);
        }

        if ($city = $request->get('city'))
        {
            $idCity = preg_replace('/[^0-9]/', '', $city);
            $arrWorkplace[] = [
                'wp_candidates_id' => $idCandidate,
                'wp_locations_id'  => $idCity
            ];
            if ($districts = $request->get('district'))
            {
                foreach ($districts as $item)
                {
                    $arrWorkplace[] = [
                        'wp_candidates_id' => $idCandidate,
                        'wp_locations_id'  => preg_replace('/[^0-9]/', '', $item)
                    ];
                }
            }
            $this->workplaceRepository->insert($arrWorkplace);
        }

        if ($idCandidate){
            $candidate=$this->candidateRepository->getOneByElastic($idCandidate);
            $param = [
                "entity"          => ["name" => "candidates"],
                "text_facets"     => [
                    [
                        "facet_name"  => "can_name",
                        "facet_value" => $candidate->can_name
                    ],
                    [
                        "facet_name"  => "can_title",
                        "facet_value" => $candidate->can_title
                    ]
                ],
                "keyword_facets"  => [
                    [
                        "facet_name"  => "can_email",
                        "facet_value" => $candidate->can_email
                    ]
                ],
                "long_facets"     => [
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $candidate->can_source_id
                    ],
                    [
                        "facet_name"  => "can_year",
                        "facet_value" => $candidate->can_year
                    ],
                    [
                        "facet_name"  => "can_gender",
                        "facet_value" => $candidate->can_gender
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_type_of_work",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_type_of_work : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_english_level",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_english_level : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_qualification",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_qualification : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_time_experience",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_time_experience : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_from",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_salary_from : null
                    ],
                    [
                        "facet_name"  => "candidate_info.ci_salary_to",
                        "facet_value" => isset($candidate->candidateInfo) ? $candidate->candidateInfo->ci_salary_to : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_evaluate",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "latest_diary.d_cantype_id",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_cantype_id : null
                    ]
                ],
                "nested_facets"   => [
                    [
                        "facet_name"  => "location",
                        "facet_value" => $candidate->location->toArray()
                    ],
                    [
                        "facet_name"  => "career",
                        "facet_value" => $candidate->career->toArray()
                    ],
                    [
                        "facet_name"  => "skill",
                        "facet_value" => $candidate->skill->toArray()
                    ],

                ],
                "date_facets"     => [
                    [
                        "facet_name"  => "can_birthday",
                        "facet_value" => $candidate->can_birthday
                    ]
                ],
                "datetime_facets" => [
                    [
                        "facet_name"  => "created_at",
                        "facet_value" => $candidate->created_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "updated_at",
                        "facet_value" => $candidate->updated_at->format('Y-m-d H:m:s')
                    ],
                    [
                        "facet_name"  => "latest_diary.created_at",
                        "facet_value" => isset($candidate->latest_diary->created_at) ? $candidate->latest_diary->created_at->format('Y-m-d H:m:s') : null
                    ]
                ],
                "aggs_facets"     => [
                    [
                        "facet_name"  => "latest_diary_d_cantype_id",
                        "facet_value" => isset($candidate->latest_diary) ? $candidate->latest_diary->d_cantype_id : null
                    ],
                    [
                        "facet_name"  => "can_source_id",
                        "facet_value" => $candidate->can_source_id
                    ],
                    [
                        "facet_name"  => "latest_diary_d_evaluate",
                        "facet_value" => isset($item->latest_diary) ? $candidate->latest_diary->d_evaluate : null
                    ],
                    [
                        "facet_name"  => "candidate_info_ci_type_of_work",
                        "facet_value" => isset($item->candidateInfo) ? $candidate->candidateInfo->ci_type_of_work : null
                    ]
                ],
                "data"            => $candidate

            ];

            $can = new Candidate();
            $can->addDocToIndex($idCandidate, $param);

            $alert = [
                'type'    => 'success',
                'message' => 'Đã sửa ứng viên!'
            ];

            \Session::flash('toastr', $alert);

        }

        return redirect('candidate/list');

    }

    public function showAjax(Request $request)
    {

        if ($id = $request->get('id'))
        {

            $candidate = Candidate::getOne($id);

        }

        return response($candidate->first());
    }

    public function destroyAjax(Request $request)
    {
        if ($id = $request->get('id'))
        {
            $can = new Candidate();
            $can->deleteDoc($id);

            $this->candidateRepository->delete($id);
            $this->candidateinfoRepository->deleteByCandidateId($id, 'ci_candidates_id');
            $this->candidateCareerRepository->deleteByCandidateId($id, 'cc_candidates_id');
            $this->candidateSkillRepository->deleteByCandidateId($id, 'cs_candidates_id');
            $this->workplaceRepository->deleteByCandidateId($id, 'wp_candidates_id');

            return response([
                'type'    => 'success',
                'message' => 'Xóa thành công!'
            ]);
        }

        return response([
            'type' => 'warm',
            'message' => 'Xóa không thành công'
        ]);

    }

    public function exportPDF(Request $request){
        if ($html=$request->get('html')){
            $pdf=\App::make('dompdf.wrapper');

            return $pdf->stream();
        }

        $alert = [
            'type'    => 'success',
            'message' => 'Đã có lỗi xảy ra!'
        ];

        \Session::flash('toastr', $alert);

        return redirect()->route('candidate.list');
    }

}

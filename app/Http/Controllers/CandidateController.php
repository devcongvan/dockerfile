<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest2;
use App\Model\Candidate;
use App\Repositories\Career\CareerEloquentRepository;
use App\Repositories\Location\LocationEloquentRepository;
use App\Repositories\Source\SourceEloquentRepository;
use function Couchbase\defaultDecoder;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use App\Repositories\CandidateCareer\CandidateCareerEloquentRepository;
use App\Repositories\CandidateSkill\CandidateSkillEloquentRepository;
use App\Repositories\Workplace\WorkplaceEloquentRepository;
use App\Repositories\CandiateInfo\CandidateInfoEloquentRepository;
use App\Repositories\Candidate\CandidateEloquentRepository;

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

    protected $careerRepository;

    public function __construct(CandidateEloquentRepository $candidateEloquentRepository,
                                CandidateInfoEloquentRepository $candidateInfoEloquentRepository,
                                CandidateCareerEloquentRepository $candidateCareerEloquentRepository,
                                CandidateSkillEloquentRepository $candidateSkillEloquentRepository,
                                WorkplaceEloquentRepository $workplaceEloquentRepository,
                                CareerEloquentRepository $careerEloquentRepository,
                                SourceEloquentRepository $sourceEloquentRepository,
                                LocationEloquentRepository $locationEloquentRepository)
    {
        $this->locationRepository = $locationEloquentRepository;
        $this->candidateSkillRepository = $candidateSkillEloquentRepository;
        $this->workplaceRepository = $workplaceEloquentRepository;
        $this->candidateCareerRepository = $candidateCareerEloquentRepository;
        $this->candidateRepository = $candidateEloquentRepository;
        $this->candidateinfoRepository = $candidateInfoEloquentRepository;
        $this->careerRepository = $careerEloquentRepository;

        $this->sourceRepository = $sourceEloquentRepository;

    }

    public function index()
    {
        $condition = [
            'orderby' => [
                'field' => 'id',
                'type' => 'desc'
            ],
            'with' => 'source'
        ];
        $candidates = $this->candidateRepository->getAll($condition, true);

//        dd(json_decode($candidates[5]->can_diary));
        return view('candidate.index', compact('candidates'));
    }

    public function store()
    {

        $cityCondition = [
            'select' => ['id', 'loc_name'],
            'where' => ['loc_parent_id' => 0]
        ];

        $data = [
            'careers' => $this->careerRepository->getAll(['select' => ['id', 'ca_name']]),
            'sources' => $this->sourceRepository->getAll(['select' => ['id', 'so_name']]),
            'city' => $this->locationRepository->getAll($cityCondition),
            'time_experience' => json_decode(file_get_contents('../public/json/time_experience.json'), true)['experience'],
            'qualification' => json_decode(file_get_contents('../public/json/qualification.json'), true)['qualification'],
            'english_level' => json_decode(file_get_contents('../public/json/english_level.json'), true)['english'],
            'type_of_work' => json_decode(file_get_contents('../public/json/type_of_work.json'), true)['type_of_work'],
            'salary' => json_decode(file_get_contents('../public/json/salary.json'), true)['salary'],

        ];

        return view('candidate.add')->with($data);
    }

    public function postStore(CandidateRequest2 $request)
    {
        if ($request->has('can_phone') && $request->has('can_email')) {
            $condidtion = [
                'count' => true,
                'where' => [
                    'can_phone' => $request->get('can_phone'),
                    'can_email' => $request->get('can_email')
                ]
            ];
            $count = $this->candidateRepository->getAll($condidtion);
            if ($count > 0) {
                return back()->with('email_phone_error', 'Email và điện thoại đã tồn tại!')->withInput();
            }
        }

        if ($experiences = $request->get('ci_work_experience_company')) {
            $ci_work_experience = [];
            foreach ($experiences as $index => $item) {
                $ci_work_experience[] = [
                    'company' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_work_experience_start')[$index]),
                    'finish' => strip_tags($request->get('ci_work_experience_finish')[$index]),
                    'time' => strip_tags($request->get('ci_work_experience_time')[$index]),
                    'position' => strip_tags($request->get('ci_work_experience_position')[$index]),
                    'process' => strip_tags($request->get('ci_work_experience_process')[$index]),
                ];
            }
        }

        if ($educations = $request->get('ci_education_name')) {
            $ci_education = [];
            foreach ($educations as $index => $item) {
                $ci_education[] = [
                    'schoolname' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_education_start')[$index]),
                    'finish' => strip_tags($request->get('ci_education_finish')[$index]),
                    'faculty' => strip_tags($request->get('ci_education_faculty')[$index]),
                    'process' => strip_tags($request->get('ci_education_process')[$index]),
                ];
            }
        }

        if ($activitys = $request->get('ci_activity_name')) {
            $ci_activity = [];
            foreach ($activitys as $index => $item) {
                $ci_activity[] = [
                    'name' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_activity_start')[$index]),
                    'finish' => strip_tags($request->get('ci_activity_finish')[$index]),
                    'position' => strip_tags($request->get('ci_activity_position')[$index]),
                    'process' => strip_tags($request->get('ci_activity_process')[$index]),
                ];
            }
        }

        if ($certificates = $request->get('ci_certificate_time')) {
            $ci_certificate = [];

            foreach ($certificates as $index => $item) {
                $ci_certificate[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_certificate_name')[$index]),
                ];
            }
        }

        if ($prizes = $request->get('ci_prize_time')) {
            $ci_prize = [];

            foreach ($prizes as $index => $item) {
                $ci_prize[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_prize_name')[$index]),
                ];
            }
        }

        if ($skills = $request->get('ci_skill_name')) {
            $ci_skill = [];
            foreach ($skills as $index => $item) {
                $ci_skill[] = [
                    'name' => strip_tags($item),
                    'evaluate' => strip_tags($request->get('ci_skill_evaluate')[$index]),
                ];
            }
        }

        $arrCandidate = [
            'can_name' => strip_tags($request->get('can_name')),
            'can_gender' => strip_tags($request->get('can_gender')),
            'can_phone' => strip_tags($request->get('can_phone')),
            'can_email' => strip_tags($request->get('can_email')),
            'hometown' => strip_tags($request->get('hometown')),
            'can_address' => strip_tags($request->get('can_address')),
            'can_skype' => strip_tags($request->get('can_skype')),
            'can_facebook' => strip_tags($request->get('can_facebook')),
            'can_linkedin' => strip_tags($request->get('can_linkedin')),
            'can_github' => strip_tags($request->get('can_github')),
            'can_source_id' => strip_tags($request->get('can_source_id')),
            'can_title' => strip_tags($request->get('can_title')),
            'can_year' => strip_tags($request->get('can_year'))
        ];

        if (!empty($request->get('can_birthday'))) {
            $arrCandidate['can_birthday'] = date("Y-m-d", strtotime($request->get('can_birthday')));
        } else {
            $arrCandidate['can_birthday'] = null;
        }

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $path = public_path('upload/avatar/');

            $file_name = rand() . '_' . $file->getClientOriginalName();

            if ($file->move($path, $file_name)) {
                $arrCandidate['can_avatar'] = '/upload/avatar/' . $file_name;
            } else {
                $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
            }
        } else {
            $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
        }

        $lastCandidateId = $this->candidateRepository->create($arrCandidate);

        $arrCandidateInfo = [
            'ci_candidates_id' => $lastCandidateId,
            'ci_work_abroad' => strip_tags($request->get('ci_work_abroad')),
            'ci_time_experience' => strip_tags($request->get('ci_time_experience')),
            'ci_qualification' => strip_tags($request->get('ci_qualification')),
            'ci_english_level' => strip_tags($request->get('ci_english_level')),
            'ci_type_of_work' => strip_tags($request->get('ci_type_of_work')),
            'ci_salary' => strip_tags($request->get('ci_salary')),
            'ci_target' => strip_tags($request->get('ci_target')),
            'ci_about' => strip_tags($request->get('ci_about')),
            'ci_work_experience' => json_encode($ci_work_experience),
            'ci_education' => json_encode($ci_education),
            'ci_activity' => json_encode($ci_activity),
            'ci_certificate' => json_encode($ci_certificate),
            'ci_prize' => json_encode($ci_prize),
            'ci_skill' => json_encode($ci_skill),
            'ci_hobby' => strip_tags($request->get('ci_hobby')),
        ];

        if ($careers = $request->get('career')) {
            $arrCandidateCareer = [];
            foreach ($careers as $item) {
                $arrCandidateCareer[] = [
                    'cc_candidates_id' => $lastCandidateId,
                    'cc_careers_id' => $item
                ];
            }
            $this->candidateCareerRepository->create($arrCandidateCareer);
        }

        if ($skills = $request->get('skill')) {
            $arrCandidateSkill = [];
            foreach ($skills as $item) {
                $idSkill = preg_replace('/[^0-9]/', '', $item);
                $arrCandidateSkill[] = [
                    'cs_candidates_id' => $lastCandidateId,
                    'cs_skills_id' => $idSkill
                ];
            }
            $this->candidateSkillRepository->create($arrCandidateSkill);
        }

        if ($city = $request->get('city')) {
            $idCity = preg_replace('/[^0-9]/', '', $city);
            $arrWorkplace[] = [
                'wp_candidates_id' => $lastCandidateId,
                'wp_locations_id' => $idCity
            ];
            if ($districts = $request->get('district')) {
                foreach ($districts as $item) {
                    $arrWorkplace[] = [
                        'wp_candidates_id' => $lastCandidateId,
                        'wp_locations_id' => preg_replace('/[^0-9]/', '', $item)
                    ];
                }
            }

            $this->workplaceRepository->create($arrWorkplace);
        }

        if ($this->candidateinfoRepository->create($arrCandidateInfo)) {

            $notification = [
                'message' => 'Thêm ứng viên thành công!',
                'alert-type' => 'success'
            ];

            return redirect('candidate/list')->with($notification);

        }

        return redirect('candidate/new');

    }

    public function importExcel(Request $request)
    {
//        dd($request->hasFile('file'));

        if ($request->hasFile('file')) {

            $path = $request->file('file')->getRealPath();

            $excelData = '';
            \Excel::load($path, function ($reader) {

                $excelData = $reader->toArray();

                $this->changeField($excelData);

            });
        }

        $notification = [
            'message' => 'Thêm ứng viên từ File Excel thành công!',
            'alert-type' => 'success'
        ];

        return redirect('candidate/list')->with($notification);
    }

    public function changeField(array $data)
    {
        $candidate_field = config('candidate_field.candidates');

        $insert = [];

        foreach ($data as $item) {
            $subItem = [];
            if (empty($item['ho_ten_uv'])) {
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
            foreach ($item as $key => $value) {
                if (!empty($candidate_field[$key])) {
                    $subItem[$candidate_field[$key]] = $value;
                } else {
                    if (strrpos($key, 'nganh_nghe_') > -1 && !empty($value)) {
                        $subItem['candidates_careers'][] = $item[$key];
                    }

                    if (strrpos($key, 'cong_ty_') > -1 && !empty($value)) {
                        $subItem['ci_experience']['companys'][] = $item[$key];
                    }

                    if (strrpos($key, 'thoi_gian_lam_viec_') > -1 && !empty($value)) {
                        $subItem['ci_experience']['time'][] = $item[$key];
                    }

                    if (strrpos($key, 'cap_bac_') > -1 && !empty($value)) {
                        $subItem['ci_experience']['position'][] = $item[$key];
                    }

                    if (strrpos($key, 'chuyen_mon_') > -1 && !empty($value)) {
                        $subItem['ci_experience']['process'][] = $item[$key];
                    }
                }
            }

            $insert[] = $subItem;
        }

        if (!empty($insert)) {
            $this->insertExcelToDatabase($insert);
        } else {
            return redirect();
        }
    }

    public function insertExcelToDatabase(array $data)
    {

        foreach ($data as $key => $item) {
            if (empty($item['can_name'])) {
                continue;
            }
            if (!empty($item['can_email'])) {
                if (count($this->candidateRepository->getAll(['select' => 'id', 'where' => ['can_name' => $item['can_name'], 'can_email' => $item['can_email']]])) > 0) {
                    continue;
                }
            }
//            Đã lấy được candidate
            $candidate = [
                'can_name' => strip_tags(!empty($item['can_name']) ? $item['can_name'] : ''),
                'can_year' => strip_tags(str_replace(".0", "", !empty($item['can_year']) ? $item['can_year'] : '')),
                'can_phone' => strip_tags(!empty($item['can_phone']) ? $item['can_phone'] : ''),
                'can_email' => strip_tags(!empty($item['can_email']) ? $item['can_email'] : ''),
                'can_facebook' => strip_tags(!empty($item['can_facebook']) ? $item['can_facebook'] : ''),
                'can_title' => strip_tags(!empty($item['can_title']) ? $item['can_title'] : ''),
            ];

            if ($lastCandidateId = $this->candidateRepository->create($candidate)) {
                if (!empty($item['candidates_careers'])) {
                    foreach ($item['candidates_careers'] as $candidates_careers_key => $candidates_career_item) {
                        if ($career = $this->careerRepository->getAll(['select' => ['id', 'ca_name'], 'where' => ['ca_name' => $candidates_career_item]])->first()) {

                            $arrCandidateCareer1 = [
                                'cc_candidates_id' => $lastCandidateId,
                                'cc_careers_id' => $career->id,
                            ];
                            $this->candidateCareerRepository->create($arrCandidateCareer1);
                        } else {
                            if ($career_id = $this->careerRepository->create(['ca_name' => $candidates_career_item])) {

                                $arrCandidateCareer2 = [
                                    'cc_candidates_id' => $lastCandidateId,
                                    'cc_careers_id' => $career_id
                                ];
                                $this->candidateCareerRepository->create($arrCandidateCareer2);
                            }
                        }
                    }
                }

                if (!empty($item['ci_experience'])) {
                    $candidate_info['ci_candidates_id'] = $lastCandidateId;

                    $candidate_info['ci_experience'] = '';

                    if (!empty($item['ci_experience'])) {
                        $jsonArray = [];
                        foreach ($item['ci_experience']['companys'] as $ci_experience_key => $ci_experience_item) {
                            $jsonArray = [
                                "company" => $ci_experience_item,
                                "start" => !empty($item['ci_experience']['start'][$ci_experience_key]) ? $item['ci_experience']['start'][$ci_experience_key] : '',
                                "finish" => !empty($item['ci_experience']['finish'][$ci_experience_key]) ? $item['ci_experience']['finish'][$ci_experience_key] : '',
                                "time" => !empty($item['ci_experience']['time'][$ci_experience_key]) ? $item['ci_experience']['time'][$ci_experience_key] : '',
                                "position" => !empty($item['ci_experience']['position'][$ci_experience_key]) ? $item['ci_experience']['position'][$ci_experience_key] : '',
                                "process" => !empty($item['ci_experience']['process'][$ci_experience_key]) ? $item['ci_experience']['process'][$ci_experience_key] : ''
                            ];
                        }
                        $candidate_info['ci_work_experience'] = json_encode($jsonArray);
                    }
                }

                $candidate_info['ci_about'] = '';

                foreach ($item as $about_key => $about) {
                    if (strrpos($about_key, 'ci_about_') > -1 && !empty($about)) {
                        $candidate_info['ci_about'] .= ' ' . $about;
                    }
                }
                $this->candidateinfoRepository->create($candidate_info);
            }
        }

        $notification = [
            'message' => 'Thêm ứng viên từ File Excel thành công!',
            'alert-type' => 'success'
        ];

        return redirect('candidate/list')->with($notification);
    }

    public function actionSource($source)
    {
        if (!is_numeric($source)) {
            if ($sourceID = $this->sourceRepository->getAll(['select' => 'id', 'search' => ['field' => 'so_name', 'string' => $source]])) {
                dd($sourceID);
            }
        }
    }

    public function update($id)
    {
        $cityCondition = [
            'select' => ['id', 'loc_name'],
            'where' => ['loc_parent_id' => 0]
        ];
        $data = [
            'careers' => $this->careerRepository->getAll(['select' => ['id', 'ca_name']]),
            'sources' => $this->sourceRepository->getAll(['select' => ['id', 'so_name']]),
            'candidate' => $this->candidateRepository->getById($id, ['candidateInfo', 'career:cc_careers_id,ca_name',
                'skill:cs_skills_id,sk_name', 'location:wp_locations_id,loc_name'
            ]),
            'city' => $this->locationRepository->getAll($cityCondition),

            'time_experience' => json_decode(file_get_contents('../public/json/time_experience.json'), true)['experience'],
            'qualification' => json_decode(file_get_contents('../public/json/qualification.json'), true)['qualification'],
            'english_level' => json_decode(file_get_contents('../public/json/english_level.json'), true)['english'],
            'type_of_work' => json_decode(file_get_contents('../public/json/type_of_work.json'), true)['type_of_work'],
            'salary' => json_decode(file_get_contents('../public/json/salary.json'), true)['salary'],

        ];

        if (!empty($data['candidate']->location->first())) {
            $data['idCity'] = $data['candidate']->location->first()->id;
        }

        if ($dataInfo = $data['candidate']->candidateInfo) {

            if ($exp = $dataInfo->ci_work_experience) {
                $data['candidate']->candidateInfo->ci_work_experience = json_decode($exp);
            }

            if ($edu = $dataInfo->ci_education) {
                $data['candidate']->candidateInfo->ci_education = json_decode($edu);
            }

            if ($activity = $dataInfo->ci_activity) {
                $data['candidate']->candidateInfo->ci_activity = json_decode($activity);
            }

            if ($certificate = $dataInfo->ci_certificate) {
                $data['candidate']->candidateInfo->ci_certificate = json_decode($certificate);
            }

            if ($prize = $dataInfo->ci_prize) {
                $data['candidate']->candidateInfo->ci_prize = json_decode($prize);
            }

            if ($skill = $dataInfo->ci_skill) {
                $data['candidate']->candidateInfo->ci_skill = json_decode($skill);
            }

        }

//        dd($data['candidate']->candidateInfo);
        return view('candidate.add')->with($data);
    }

    public function updatePost(CandidateRequest2 $request)
    {
        if ($request->has('can_phone') && $request->has('can_email')) {
            $condidtion = [
                'count' => true,
                'where' => [
                    'can_phone' => $request->get('can_phone'),
                    'can_email' => $request->get('can_email'),
                    ['id', '<>', $request->get('candidate_id')]
                ]
            ];
            $count = $this->candidateRepository->getAll($condidtion);
            if ($count > 0) {
                return back()->with('email_phone_error', 'Email và điện thoại đã tồn tại!')->withInput();
            }
        }
        if ($experiences = $request->get('ci_work_experience_company')) {
            $ci_work_experience = [];
            foreach ($experiences as $index => $item) {
                $ci_work_experience[] = [
                    'company' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_work_experience_start')[$index]),
                    'finish' => strip_tags($request->get('ci_work_experience_finish')[$index]),
                    'position' => strip_tags($request->get('ci_work_experience_position')[$index]),
                    'process' => strip_tags($request->get('ci_work_experience_process')[$index]),
                ];
            }
        }

        if ($educations = $request->get('ci_education_name')) {
            $ci_education = [];
            foreach ($educations as $index => $item) {
                $ci_education[] = [
                    'schoolname' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_education_start')[$index]),
                    'finish' => strip_tags($request->get('ci_education_finish')[$index]),
                    'faculty' => strip_tags($request->get('ci_education_faculty')[$index]),
                    'process' => strip_tags($request->get('ci_education_process')[$index]),
                ];
            }
        }

        if ($activitys = $request->get('ci_activity_name')) {
            $ci_activity = [];
            foreach ($activitys as $index => $item) {
                $ci_activity[] = [
                    'name' => strip_tags($item),
                    'start' => strip_tags($request->get('ci_activity_start')[$index]),
                    'finish' => strip_tags($request->get('ci_activity_finish')[$index]),
                    'position' => strip_tags($request->get('ci_activity_position')[$index]),
                    'process' => strip_tags($request->get('ci_activity_process')[$index]),
                ];
            }
        }

        if ($certificates = $request->get('ci_certificate_time')) {
            $ci_certificate = [];

            foreach ($certificates as $index => $item) {
                $ci_certificate[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_certificate_name')[$index]),
                ];
            }
        }

        if ($prizes = $request->get('ci_prize_time')) {
            $ci_prize = [];

            foreach ($prizes as $index => $item) {
                $ci_prize[] = [
                    'time' => strip_tags($item),
                    'name' => strip_tags($request->get('ci_prize_name')[$index]),
                ];
            }
        }

        if ($skills = $request->get('ci_skill_name')) {
            $ci_skill = [];
            foreach ($skills as $index => $item) {
                $ci_skill[] = [
                    'name' => strip_tags($item),
                    'evaluate' => strip_tags($request->get('ci_skill_evaluate')[$index]),
                ];
            }
        }

        $arrCandidate = [
            'can_name' => strip_tags($request->get('can_name')),
            'can_birthday' => strip_tags(date("Y-m-d", strtotime($request->get('can_birthday')))),
            'can_gender' => strip_tags($request->get('can_gender')),
            'can_phone' => strip_tags($request->get('can_phone')),
            'can_email' => strip_tags($request->get('can_email')),
            'hometown' => strip_tags($request->get('hometown')),
            'can_address' => strip_tags($request->get('can_address')),
            'can_skype' => strip_tags($request->get('can_skype')),
            'can_facebook' => strip_tags($request->get('can_facebook')),
            'can_linkedin' => strip_tags($request->get('can_linkedin')),
            'can_github' => strip_tags($request->get('can_github')),
            'can_source_id' => strip_tags($request->get('can_source_id')),
            'can_title' => strip_tags($request->get('can_title')),
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $path = public_path('upload/avatar/');

            $old_file = public_path($request->get('old_avatar'));

            if (file_exists($old_file)) {
                unlink($old_file);
            }

            $file_name = rand() . '_' . $file->getClientOriginalName();

            if ($file->move($path, $file_name)) {
                $arrCandidate['can_avatar'] = '/upload/avatar/' . $file_name;
            } else {
                $arrCandidate['can_avatar'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Missing_avatar.svg/2000px-Missing_avatar.svg.png';
            }
        }

        if ($idCandidate = $request->get('candidate_id')) {
            $this->candidateRepository->update($idCandidate, $arrCandidate);
            $this->workplaceRepository->deleteByCandidateId($idCandidate, 'wp_candidates_id');
            $this->candidateCareerRepository->deleteByCandidateId($idCandidate, 'cc_candidates_id');
            $this->candidateSkillRepository->deleteByCandidateId($idCandidate, 'cs_candidates_id');
        }

        $arrCandidateInfo = [
            'ci_candidates_id' => $idCandidate,
            'ci_work_abroad' => strip_tags($request->get('ci_work_abroad')),
            'ci_time_experience' => strip_tags($request->get('ci_time_experience')),
            'ci_qualification' => strip_tags($request->get('ci_qualification')),
            'ci_english_level' => strip_tags($request->get('ci_english_level')),
            'ci_type_of_work' => strip_tags($request->get('ci_type_of_work')),
            'ci_salary' => strip_tags($request->get('ci_salary')),
            'ci_target' => strip_tags($request->get('ci_target')),
            'ci_about' => strip_tags($request->get('ci_about')),
            'ci_work_experience' => json_encode($ci_work_experience),
            'ci_education' => json_encode($ci_education),
            'ci_activity' => json_encode($ci_activity),
            'ci_certificate' => json_encode($ci_certificate),
            'ci_prize' => json_encode($ci_prize),
            'ci_skill' => json_encode($ci_skill),
            'ci_hobby' => strip_tags($request->get('ci_hobby')),
        ];

        if ($idCandidateInfo = $request->get('candidateInfo_id')) {
            $this->candidateinfoRepository->update($idCandidateInfo, $arrCandidateInfo);
        }

        if ($careers = $request->get('career')) {
            $arrCandidateCareer = [];
            foreach ($careers as $item) {
                $arrCandidateCareer[] = [
                    'cc_candidates_id' => $idCandidate,
                    'cc_careers_id' => $item
                ];
            }
            $this->candidateCareerRepository->create($arrCandidateCareer);
        }

        if ($skills = $request->get('skill')) {
            $arrCandidateSkill = [];
            foreach ($skills as $item) {
                $idSkill = preg_replace('/[^0-9]/', '', $item);
                $arrCandidateSkill[] = [
                    'cs_candidates_id' => $idCandidate,
                    'cs_skills_id' => $idSkill
                ];
            }
            $this->candidateSkillRepository->create($arrCandidateSkill);
        }

        if ($city = $request->get('city')) {
            $idCity = preg_replace('/[^0-9]/', '', $city);
            $arrWorkplace[] = [
                'wp_candidates_id' => $idCandidate,
                'wp_locations_id' => $idCity
            ];
            if ($districts = $request->get('district')) {
                foreach ($districts as $item) {
                    $arrWorkplace[] = [
                        'wp_candidates_id' => $idCandidate,
                        'wp_locations_id' => preg_replace('/[^0-9]/', '', $item)
                    ];
                }
            }
            $this->workplaceRepository->create($arrWorkplace);
        }

        $notification = [
            'message' => 'Sửa ứng viên thành công!',
            'alert-type' => 'success'
        ];

        return redirect('candidate/list')->with($notification);

    }

    public function showAjax(Request $request)
    {
        $id = $request->get('id');

        $result = $this->candidateRepository->getById($id);

        return response([
//            'candidate'     => $result->toArray(),
//            'candidateInfo' => $result->candidateInfo()->get()->toArray()[0],
            'candidate' => $this->candidateRepository->getById($id, ['candidateInfo', 'career:ca_name',
                'skill:sk_name', 'location:loc_name'])

        ]);

    }

    public function destroyAjax(Request $request)
    {
        if ($id = $request->get('id')) {
            $this->candidateRepository->delete($id);
            $this->candidateinfoRepository->deleteByCandidateId($id, 'ci_candidates_id');
            $this->candidateCareerRepository->deleteByCandidateId($id, 'cc_candidates_id');
            $this->candidateSkillRepository->deleteByCandidateId($id, 'cs_candidates_id');
            $this->workplaceRepository->deleteByCandidateId($id, 'wp_candidates_id');

            return response([
                'message' => 'Xóa thành công'
            ]);
        }

        return response([
            'message' => 'Xóa không thành công'
        ]);

    }

}

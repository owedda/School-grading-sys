<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\UserLessonsDTO;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserLesson;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserLesson\UserLessonRepositoryInterface;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use App\Collections\DataCollection;

class UserLessonController extends Controller
{
    public function __construct(private readonly UserLessonRepositoryInterface $userLessonRepository)
    {
    }

    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        $user = User::whereId($userId)->first();
//        $allLessons = Lesson::all()->toArray();
//
//        $userLessons = UserLesson::where('user_id', $userId)->with('lessons')->get()->toArray();
//
//
//        $collectionAllLessons = new DataCollection($allLessons);
//        $collectionHaveLessons = new DataCollection($userLessons);
//        $sendCollection = new DataCollection();
//
//        foreach ($collectionAllLessons as $value)
//        {
//            $item = $collectionHaveLessons->firstWhere('lesson_id', $value['id']);
//
//
//            if (is_null($item) === false) {
//                Debugbar::error(json_encode($item['id']));
//                $sendCollection->add(new UserLessonsDTO($value['id'], $value['name'], true, $item['id']));
//            } else {
//                $sendCollection->add(new UserLessonsDTO($value['id'], $value['name'], false));
//            }
//        }
        $sendCollection = $this->userLessonRepository->getAllLessonsCollectionWithAssignedStudentsOrNull($request);

        return view('userLessons.index', compact('sendCollection', 'user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userLesson = new UserLesson();
        $userLesson->user_id = $request->input('user_id');
        $userLesson->lesson_id = $request->input('$lesson_id');
        $userLesson->save();

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(UserLesson $userLesson)
    {
        $userLesson->delete();
        return back();
    }
}

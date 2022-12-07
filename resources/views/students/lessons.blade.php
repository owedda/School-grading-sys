@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ $user->getName() }} lessons
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                    <thead>
                    <tr>
                        <th>
                            Lesson
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userAttendedLessonsCollection as $userAttendingLesson)
                        <tr>
                            <td>
                                {{ $userAttendingLesson->getLessonModel()->getName() ?? '' }}
                            </td>
                            <td>
                                @if($userAttendingLesson->getUserLessonModel() !== null)
                                    <form action="{{ route('students.destroyUserLesson', $userAttendingLesson->getUserLessonModel()->getId()) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @else
                                    <form action="{{ route('students.storeUserLesson', ['user-id' => $user->getId(), 'lesson-id' => $userAttendingLesson->getLessonModel()->getId()]) }}" method="POST">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-info" value="Add">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

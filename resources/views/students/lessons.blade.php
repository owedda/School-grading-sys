@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ $studentLessons->getUser()->getName() }} lessons
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
                    @foreach($studentLessons->getLessons() as $lesson)
                        <tr>
                            <td>
                                {{ $lesson->getLessonModel()->getName() ?? '' }}
                            </td>
                            <td>
                                @if($lesson->getUserLessonModel() !== null)
                                    <form
                                        action="{{ route('students.destroyUserLesson', $lesson->getUserLessonModel()->getId()) }}"
                                        method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                @else
                                    <form
                                        action="{{ route('students.storeUserLesson', ['user-id' => $studentLessons->getUser()->getId(), 'lesson-id' => $lesson->getLessonModel()->getId()]) }}"
                                        method="POST">
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

@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ $user->getName() }} {{ trans('menu.lessons') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.asset.fields.id') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersAttendingLessonsCollection as $key => $userAttendingLesson)

                            <td>
                                {{ $userAttendingLesson->getLessonName() ?? '' }}
                            </td>
                            <td>
                                @if($userAttendingLesson->isInLesson())
                                    <form action="{{ route('userLessons.destroy', $userAttendingLesson->getUserLessonId()) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
                                    </form>
                                @else
                                    <form action="{{ route('userLessons.store', ['user-id' => $user->getId(), 'lesson-id' => $userAttendingLesson->getLessonId()]) }}" method="POST">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-info" value="Add">
                                    </form>

                                @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

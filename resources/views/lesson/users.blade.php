@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        {{ $lesson->getName() }}
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('lessons.users', ['lessonId' => $lesson->getId()]) }}"  style="display: inline-block;">
            @csrf
            <input type="date" id="date"  name="date" value="{{ $date }}"/>
            <input type="submit" class="btn btn-xs btn-info" value="Update">
        </form>

        <div align="right">
            Selected date: {{ $date }}
        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th>
                            Username
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Last name
                        </th>
                        <th>
                            Evaluation
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usersInConcreteLessonCollection as $key => $user)
                    <tr>
                        <td>
                            {{ $user->getUsername() ?? '' }}
                        </td>
                        <td>
                            {{ $user->getName() ?? '' }}
                        </td>
                        <td>
                            {{ $user->getLastName() ?? '' }}
                        </td>
                        <td>
                            {{ $user->getEvaluationValue() ?? '' }}
                        </td>
                        <td>
                            @if(is_null($user->getEvaluationValue()))
                                <form method="POST" action="{{ route('evaluations.store') }}"  style="display: inline-block;">
                                    @csrf
                                    <input type="hidden" name="date" value="{{ $date }}">
                                    <input type="hidden" name="user-lesson-id" value={{ $user->getUserLessonId() }}>
                                    <input type="number" id="number" type="number" name="value" min="1" max="10" required>
                                    <input type="submit" class="btn btn-xs btn-success" value="Save">
                                </form>
                            @else
                                <form method="POST" action="{{ route('evaluations.destroy', ['id' => $user->getEvaluationId()]) }}"  style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Remove">
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



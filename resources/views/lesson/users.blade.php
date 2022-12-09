@extends('layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ $usersResponseModel->getLesson()->getName() }}
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('lessons.users', ['lessonId' => $usersResponseModel->getLesson()->getId()]) }}"
                  style="display: inline-block;">
                @csrf
                <input type="date" id="date" name="date"
                       value="{{ $usersResponseModel->getDate()->format(\App\Constants\DateConstants::DATE_FORMAT_FULL) }}"/>
                <input type="submit" class="btn btn-xs btn-info" value="Update">
            </form>

            <div align="right">
                Selected
                date: {{ $usersResponseModel->getDate()->format(\App\Constants\DateConstants::DATE_FORMAT_FULL) }}
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
                    @foreach($usersResponseModel->getUsersEvaluations() as $user)
                        <tr>
                            <td>
                                {{ $user->getUser()->getUsername() ?? '' }}
                            </td>
                            <td>
                                {{ $user->getUser()->getName() ?? '' }}
                            </td>
                            <td>
                                {{ $user->getUser()->getLastName() ?? '' }}
                            </td>
                            <td>
                                @if($user->getEvaluation() !== null)
                                    {{ $user->getEvaluation()->getValue() }}
                               @endif
                            </td>
                            <td>
                                @if($user->getEvaluation() === null)
                                    <form method="POST" action="{{ route('lessons.storeEvaluation') }}"
                                          style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="date"
                                               value="{{ $usersResponseModel->getDate()->format(\App\Constants\DateConstants::DATE_FORMAT_FULL) }}">
                                        <input type="hidden" name="user-lesson-id"
                                               value={{ $user->getUserLesson()->getId() }}>
                                        <input type="number" id="number" name="value" min="1" max="10"
                                               required>
                                        <input type="submit" class="btn btn-xs btn-success" value="Save">
                                    </form>
                                @else
                                    <form method="POST"
                                          action="{{ route('lessons.destroyEvaluation', ['id' => $user->getEvaluation()->getId()]) }}"
                                          style="display: inline-block;">
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



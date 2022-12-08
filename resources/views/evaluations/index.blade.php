@extends('layouts.main')
@section('content')
    @section(true)
        {{ date_default_timezone_set('Europe/Vilnius') }}
    @endsection

    <div class="card">
        <div class="card-header">
            Evaluations user: {{ $username }}
        </div>
        <div class="card-header">
            From date: {{  $month->getDate()->format('Y-m') }}
        </div>
        <div class="card-header">
            Month:
            <div>
                <form method="GET" action="{{ route('evaluations.index')}}" style="display: inline-block;">
                    <input type="hidden" id="date" name="date"
                           value="{{ $month->getDate()->modify('-1 month')->format('Y-m-d') }}"/>
                    <input type="submit" class="btn btn-xs btn-danger" value="Previous">
                </form>

                <form method="GET" action="{{ route('evaluations.index')}}" style="display: inline-block;">
                    <input type="hidden" id="date" name="date"
                           value="{{ $month->getDate()->modify('+2 month')->format('Y-m-d') }}"/>
                    <input type="submit" class="btn btn-xs btn-success" value="Next">
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                    <thead>
                    <tr>
                        <th>
                            Lesson
                        </th>
                        @foreach($month->getDaysCollection() as $day)
                            <th>
                                {{ $day }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluations as $lessonEvaluation)
                        <tr>
                            <td>
                                {{ $lessonEvaluation->getLesson()->getName() }}
                            </td>

                            @foreach($month->getDaysCollection() as $day)
                                <th>
                                    @foreach($lessonEvaluation->getEvaluations() as $evaluation)
                                        @if($evaluation->getDate()->format(\App\Constants\DateConstants::DAY_FORMAT) === $day)
                                            {{ $evaluation->getValue() }}
                                        @endif
                                    @endforeach
                                </th>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

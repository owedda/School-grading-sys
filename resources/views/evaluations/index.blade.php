@extends('layouts.main')
@section('content')
    @section(true)
        {{ date_default_timezone_set('Europe/Vilnius') }}
    @endsection

    <div class="card">
        <div class="card-header">
            Evaluations user: {{ $user->getName() }} {{ $user->getLastName() }}
        </div>
        <div class="card-header">
            From date: {{  $evaluationDisplayDate->getDate()->format('Y-m') }}
        </div>
        <div class="card-header">
            Month:
            <div>
                <form method="GET" action="{{ route('evaluations.index')}}"  style="display: inline-block;">
                    <input type="hidden" id="date"  name="date" value="{{ $evaluationDisplayDate->getDate()->modify('-1 month')->format('Y-m-d') }}"/>
                    <input type="submit" class="btn btn-xs btn-danger" value="Previous">
                </form>

                <form method="GET" action="{{ route('evaluations.index')}}"  style="display: inline-block;">
                    <input type="hidden" id="date"  name="date" value="{{ $evaluationDisplayDate->getDate()->modify('+2 month')->format('Y-m-d') }}"/>
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
                        @foreach($evaluationDisplayDate->getDaysCollection() as $day)
                            <th>
                                {{ $day }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessonsEvaluations as $key => $lesson)
                        <tr>
                            <td>
                                {{ $lesson->getLessonName() }}
                            </td>

                            @if(is_null($lesson->getEvaluations()))
                                @foreach($evaluationDisplayDate->getDaysCollection() as $day)
                                        <th>

                                        </th>
                                @endforeach
                            @else
                                @foreach($evaluationDisplayDate->getDaysCollection() as $day)
                                    <th>
                                        @foreach($lesson->getEvaluations() as $key => $evaluation)
                                            @if($evaluation->getDay() === $day)
                                                {{ $evaluation->getValue() }}
                                            @endif
                                        @endforeach
                                    </th>
                                @endforeach
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

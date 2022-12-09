@extends('layouts.main')
@section('content')
    @section(true)
        {{ date_default_timezone_set('Europe/Vilnius') }}
    @endsection

    <div class="card">
        <div class="card-header">
            Evaluations user: {{ $evaluationsResponseModel->getusername() }}
        </div>
        <div class="card-header">
            From date: {{  $evaluationsResponseModel->getMonth()->getDate()->format('Y-m') }}
        </div>
        <div class="card-header">
            Month:
            <div>
                <form method="GET" action="{{ route('evaluations.index')}}" style="display: inline-block;">
                    <input type="hidden" id="date" name="date"
                           value="{{ $evaluationsResponseModel->getMonth()->getDate()->modify('-1 month')->format('Y-m-d') }}"/>
                    <input type="submit" class="btn btn-xs btn-danger" value="Previous">
                </form>

                <form method="GET" action="{{ route('evaluations.index')}}" style="display: inline-block;">
                    <input type="hidden" id="date" name="date"
                           value="{{ $evaluationsResponseModel->getMonth()->getDate()->modify('+2 month')->format('Y-m-d') }}"/>
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
                        @foreach($evaluationsResponseModel->getMonth()->getDaysCollection() as $day)
                            <th>
                                {{ $day }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluationsResponseModel->getEvaluations() as $lessonEvaluation)
                        <tr>
                            <td>
                                {{ $lessonEvaluation->getLesson()->getName() }}
                            </td>

                            @foreach($evaluationsResponseModel->getMonth()->getDaysCollection() as $day)
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

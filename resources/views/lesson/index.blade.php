@extends('layouts.main')
@section('content')
@section(true)
    {{ date_default_timezone_set('Europe/Vilnius') }}
@endsection

    <div class="card">
        <div class="card-header">
            {{ 'Lessons' }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                    <thead>
                    <tr>
                        <th>
                            Select Lesson
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $key => $lesson)
                        <tr>
                           <td>
                               <form method="GET" action="{{ route('lessons.users', ['lessonId' => $lesson->getId()]) }}"  style="display: inline-block;">
                                   @csrf
                                   <input type="hidden" id="date"  name="date" value="{{ date("Y-m-d") }}"/>
                                   <input type="submit" class="btn btn-xs btn-success" value="{{ $lesson->getName() }}">
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

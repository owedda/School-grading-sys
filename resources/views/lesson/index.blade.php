@extends('layouts.main')
@section('content')

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
                               <a class="btn btn-xs btn-success" href="{{ route('lessons.index') }}">
                                   {{ $lesson->name }}
                               </a>
                           </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

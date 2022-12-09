@extends('layouts.main')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("students.create") }}">
                Add Student
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Students:
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
                            Email
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $key => $student)
                        <tr>
                            <td>
                                {{ $student->getUsername() ?? '' }}
                            </td>
                            <td>
                                {{ $student->getName() ?? '' }}
                            </td>
                            <td>
                                {{ $student->getLastName() ?? '' }}
                            </td>
                            <td>
                                {{ $student->getEmail() ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info"
                                   href="{{ route('students.lessons', ['userId'=>$student->getId()]) }}">
                                    Add to a lesson
                                </a>

                                <form action="{{ route('students.destroy', $student->getId()) }}" method="POST"
                                      onsubmit="return confirm('Are you sure want to delete this student?');"
                                      style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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


@extends('layouts.main')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("users.create") }}">
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
                    @foreach($users as $key => $user)
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
                                {{ $user->getEmail() ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('users.lessons', ['userId'=>$user->getId()]) }}">
                                    Add to a lesson
                                </a>

                                <form action="{{ route('users.destroy', $user->getId()) }}" method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');" style="display: inline-block;">
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


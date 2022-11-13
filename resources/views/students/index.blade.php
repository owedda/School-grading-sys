@extends('layouts.main')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("users.create") }}">
                    {{ __('global.add') }} {{ __('cruds.user.title_singular') }}
                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            {{ __('cruds.user.title_singular') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>
                                {{ __('cruds.user.fields.username') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.last_name') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.email') }}
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
                                <a class="btn btn-xs btn-info" href="{{ route('userLessons.index', ['user-id'=>$user->getId()]) }}">
                                    {{ __('global.add_to_lesson') }}
                                </a>

                                <form action="{{ route('users.destroy', $user->getId()) }}" method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
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
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            $('.datatable-UserModel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection


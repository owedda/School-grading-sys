@extends('layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            Register student
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="username">Username</label>
                    <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="" required>
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="last-name">Last name</label>
                    <input class="form-control {{ $errors->has('last-name') ? 'is-invalid' : '' }}" type="text" name="last-name" id="last-name" value="{{ old('last-name', '') }}" required>
                    @if($errors->has('last-name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last-name') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label class="required" for="password">Password</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

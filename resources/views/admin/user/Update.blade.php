@extends('welcome')

{{--Секция для редактирования аккаунта--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                @if(isset($user))
                    <h1>Редактирование {{$user->name}}</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Аккаунт успешно отредактирован!</div>
                    @endif
                @else
                    <h1>Создание нового аккаунта</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Аккаунт успешно создан!</div>
                    @endif
                @endif
                <form method="POST" action="{{route('admin.users.update', ['user' => $user->id])}}">
                    @csrf
                    @isset($user)
                        <input type="hidden" name="_method" value="PUT">
                    @endisset
                    <div class="mb-3">
                        <label for="inputFullName" class="form-label">ФИО:</label>
                        <input type="text" name="fullName" class="form-control @error('fullName') is-invalid @enderror" id="inputFullName" placeholder="ФИО" aria-describedby="invalidInputFullName" value="{{old('fullName')}}">
                        @error('fullName') <div id="invalidInputFullName" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Почта:</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="test@gmail.com" aria-describedby="invalidInputEmail" value="{{old('email')}}">
                        @error('email') <div id="invalidInputEmail" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Телефон:</label>
                        <input maxlength="12" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" aria-describedby="invalidPhoneFeedback" value="{{old('phone')}}">
                        @error('phone')<div id="invalidPhoneFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputRole" class="form-label">Роль:</label>
                        <select id="inputRole" name="role_id" class="form-select @error('role_id') is-invalid @enderror" aria-describedby="invalidInputRole">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id') <div id="invalidInputRole" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Отредактировать аккаунт</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

@extends('welcome')

{{--Секция для регистрации--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-10">
                <h1>Регистрация нового пользователя</h1>
                @auth
                    <div class="alert alert-primary">Вы уже авторизированы. Регистрация не возможна</div>
                @endauth
                @guest
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="inputFullName" class="form-label">Ваше ФИО:</label>
                            <input type="text" name="fullName" class="form-control @error('fullName') is-invalid @enderror" id="inputFullName" aria-describedby="invalidFullNameFeedback" value="{{old('fullName')}}">
                            @error('fullName')<div id="invalidFullNameFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputGender" class="form-label">Пол:</label>
                            <select id="inputGender" name="gender" class="form-select @error('gender') is-invalid @enderror" aria-describedby="invalidInputGender">
                                <option value="Мужчина">Мужчина</option>
                                <option value="Женщина">Женщина</option>
                            </select>
                            @error('gender') <div id="invalidInputGender" class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputBirthday" class="form-label">Дата рождения:</label>
                            <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" aria-describedby="invalidEmailFeedback" value="{{old('birthday')}}">
                            @error('birthday')<div id="invalidBirthdayFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPhone" class="form-label">Телефон:</label>
                            <input maxlength="12" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" aria-describedby="invalidPhoneFeedback" value="{{old('phone')}}">
                            @error('phone')<div id="invalidPhoneFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Электронная почта:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="invalidEmailFeedback" value="{{old('email')}}">
                            @error('email')<div id="invalidEmailFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Пароль:</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" aria-describedby="invalidPasswordFeedback">
                            @error('password')<div id="invalidPasswordFeedback" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPasswordConfirmation" class="form-label">Повтор пароля:</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirmation" aria-describedby="invalidPasswordConfirmationFeedback">
                            @error('password')<div id="inputPasswordConfirmation" class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="privacy" class="form-check-input @error('privacy') is-invalid @enderror " id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Согласие с политикой конфиденциальности.</label>
                            @error('privacy') <div id="invalidEmailFeedback" class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Регистрация</button>
                    </form>
                @endguest
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

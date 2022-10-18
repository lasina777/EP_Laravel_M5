@extends('welcome')

{{--Секция для вывода одного пользователя(подробно)--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('success'))
                    @if(session()->get('success'))
                        <div class="alert alert-success">Аккаунт успешно удален!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа к данному аккаунту!</div>
                    @endif
                @endif
                    <div class="card mt-2">
                        <div class="card-header">
                            {{ $user->role->name }}: {{$user->fullName}}
                        </div>
                        <div class="card-body">
                            <li class="list-group-item">ФИО: {{$user->fullName}}</li>
                            <li class="list-group-item">Пол: {{$user->gender}}</li>
                            <li class="list-group-item">Дата рождения: {{$user->birthday}}</li>
                            <li class="list-group-item">Роль: {{ $user->role->name }}</li>
                            <li class="list-group-item">Телефон: {{ $user->phone }}</li>
                            <li class="list-group-item">Почта: {{ $user->email }}</li>
                            <a href="{{route('admin.users.edit', ['user' => $user->id])}}" class="btn btn-primary mt-2"><i class="fi-edit"></i></a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{route('admin.users.destroy', ['user' => $user->id])}}" class="btn btn-danger mt-2"><i class="fi-trash"></i></button>
                        </div>
                    </div>
                </div>
            <div class="col"></div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить аккаунт {{$user->fullName}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы точно хотите удалить аккаунт:{{$user->fullName}}?
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Solid button group">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                        <form action="{{route('admin.users.destroy', ['user' => $user->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Да я точно хочу удалить данный аккаунт!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

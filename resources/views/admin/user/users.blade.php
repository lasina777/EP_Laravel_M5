@extends('welcome')

{{--Секция для вывода всех пользователей--}}
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
                @if(session()->has('register'))
                    @if(session()->get('register'))
                        <div class="alert alert-success">Аккаунт успешно создан!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа!</div>
                    @endif
                @endif
                @if(session()->has('update'))
                    @if(session()->get('update'))
                        <div class="alert alert-success">Аккаунт успешно отредактирован!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа!</div>
                    @endif
                @endif
                @if(session()->has('role'))
                    @if(session()->get('role'))
                        <div class="alert alert-success">Роль аккаунта успешно отредактирована!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа!</div>
                    @endif
                @endif
                @if(session()->has('competence'))
                    @if(session()->get('competence'))
                        <div class="alert alert-success">Компетенция аккаунта успешно изменена!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа!</div>
                    @endif
                @endif
                @if(Auth::user()->role_id == 3)
                    <h2>Список пользователей</h2>
                @endif
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @forelse($users as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order_{{ $key }}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <div class="p-1">{{$item->role->name}}: {{$item->fullName}}</div>
                                </button>
                            </h2>
                            <div id="order_{{ $key }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">ФИО: {{$item->fullName}}</li>
                                        <li class="list-group-item">Пол: {{$item->gender}}</li>
                                        <li class="list-group-item">Дата рождения: {{$item->birthday}}</li>
                                        <li class="list-group-item">Роль: {{ $item->role->name }}</li>
                                        @if($item->role->name == 'Врач')
                                            <li class="list-group-item">Компетенция: {{ $item->competence->name ?? 'Нет компетенции' }}</li>
                                        @endif
                                        <li class="list-group-item">Телефон: {{ $item->phone }}</li>
                                        <li class="list-group-item">Почта: {{ $item->email }}</li>
                                    </ul>
                                        <a href="{{route('admin.users.edit', ['user' => $item->id])}}" class="btn btn-primary mt-2"><i class="fi-edit"></i></a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $key }}" href="{{route('admin.users.destroy', ['user' => $item->id])}}" class="btn btn-danger mt-2"><i class="fi-trash"></i></button>
                                        <a href="{{route('admin.users.show', ['user' => $item->id])}}" class="btn btn-info text-white mt-2">Посмотреть</a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalEdit_{{ $key }}" class="btn btn-accent mt-2">Изменить роль</button>
                                        @if($item->role->name == 'Врач')
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate_{{ $key }}" class="btn btn-success mt-2">Изменить компетенцию</button>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModalUpdate_{{ $key }}" tabindex="-1" aria-labelledby="exampleModalUpdateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Отредактировать компетенцию аккаунта {{$item->fullName}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('admin.editCompetence', ['user' => $item->id])}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="inputCompetence" class="form-label">Компетенция:</label>
                                                <select id="inputCompetence" name="competence_id" class="form-select @error('competence_id') is-invalid @enderror" aria-describedby="invalidInputCompetence">
                                                    @foreach($competences as $competence)
                                                        <option value="{{$competence->id}}" @if($competence->id == $item->competence_id) selected @endif>{{$competence->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id') <div id="invalidInputCompetence" class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Solid button group">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-success btn-sm">Подтвердить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModalEdit_{{ $key }}" tabindex="-1" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Отредактировать роль аккаунта {{$item->fullName}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('admin.editRole', ['user' => $item->id])}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="inputRole" class="form-label">Роль:</label>
                                                <select id="inputRole" name="role_id" class="form-select @error('role_id') is-invalid @enderror" aria-describedby="invalidInputRole">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}" @if($role->id == $item->role_id) selected @endif>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id') <div id="invalidInputRole" class="invalid-feedback">{{$message}}</div> @enderror
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Solid button group">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-success btn-sm">Подтвердить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal_{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Удалить аккаунт {{$item->fullName}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Вы точно хотите удалить аккаунт: {{$item->fullName}}?
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group" role="group" aria-label="Solid button group">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                                            <form action="{{route('admin.users.destroy', ['user' => $item->id])}}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Да я точно хочу удалить данный аккаунт!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">Нет пользователей!</div>
                    @endforelse
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

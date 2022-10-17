@extends('welcome')

{{--Секция для вывода роллей--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('success'))
                    @if(session()->get('success'))
                        <div class="alert alert-success">Роль успешно изменена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                @if(session()->has('delete'))
                    @if(session()->get('delete'))
                        <div class="alert alert-success">Роль успешно удалена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                @if(session()->has('add'))
                    @if(session()->get('add'))
                        <div class="alert alert-success">Роль успешно добавлена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                @if(session()->has('edit'))
                    @if(session()->get('edit'))
                        <div class="alert alert-success">Роль успешно изменена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif

                <h2>Роли: </h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Наименование на английском</th>
                        <th scope="col">Редактирование</th>
                        <th scope="col">Удаление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($roles))
                        @csrf
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->EN_name}}</td>
                                <td><a href="{{route('admin.roles.edit', ['role' => $role->id])}}" class="btn btn-primary">Редактирование</a> </td>
                                <td><button class="btn btn-danger" id="roleDelete_{{$role->id}}" data-bs-toggle="modal" data-bs-target="#roleDelete_{{$role->id}}" type="button">Удаление</button></td>
                            </tr>
                            <div class="modal fade" id="roleDelete_{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Удалить роль {{$role->EN_name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Вы точно хотите удалить роль
                                            {{$role->EN_name}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <form action="{{route('admin.roles.destroy', ['role' => $role->id])}}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Да, я точно хочу удалить данную роль</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Пока ролей нет!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

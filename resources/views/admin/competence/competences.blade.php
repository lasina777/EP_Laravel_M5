@extends('welcome')

{{--Секция для вывода роллей--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('delete'))
                    @if(session()->get('delete'))
                        <div class="alert alert-success">Компетенция успешно удалена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                @if(session()->has('add'))
                    @if(session()->get('add'))
                        <div class="alert alert-success">Компетенция успешно добавлена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                @if(session()->has('edit'))
                    @if(session()->get('edit'))
                        <div class="alert alert-success">Компетенция успешно изменена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif

                <h2>Компетенции: </h2>

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
                    @if(isset($competences))
                        @csrf
                        @foreach($competences as $competence)
                            <tr>
                                <td>{{$competence->name}}</td>
                                <td>{{$competence->EN_name}}</td>
                                <td><a href="{{route('admin.competences.edit', ['competence' => $competence->id])}}" class="btn btn-primary w-100"><i class="fi-edit"></i></a> </td>
                                <td><button class="btn btn-danger w-100" id="competenceDelete_{{$competence->id}}" data-bs-toggle="modal" data-bs-target="#competenceDelete_{{$competence->id}}" type="button"><i class="fi-trash"></i></button></td>
                            </tr>
                            <div class="modal fade" id="competenceDelete_{{$competence->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Удалить компетенцию {{$competence->cabinetNumber}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Вы точно хотите удалить компетенцию {{$competence->name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group" role="group" aria-label="Solid button group">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                                                <form action="{{route('admin.competences.destroy', ['competence' => $competence->id])}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Да, я точно хочу удалить данную компетенцию</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Пока компетенций нет!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

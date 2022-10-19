@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                @if(session()->has('addRecord'))
                    @if(session()->get('addRecord'))
                        <div class="alert alert-success">Вы успешно записались к врачу!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif
                <form method="post" action="{{route('records.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputRole" class="form-label">Роль:</label>
                        <select id="inputRole" name="role_id" class="form-select @error('role_id') is-invalid @enderror" aria-describedby="invalidInputRole">
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->fullName}} / {{$doctor->competence->name ?? 'Нет компетенции'}}</option>
                            @endforeach
                        </select>
                        @error('role_id') <div id="invalidInputRole" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                            Записаться
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

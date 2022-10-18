@extends('welcome')

{{--Секция для создания или редактирования кабинетов--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <form method="post" action="{{(isset($cabinet) ? route('admin.cabinets.update', ['cabinet' => $cabinet->id]) : route('admin.cabinets.store'))}}">
                    @csrf
                    @isset($cabinet)
                        <input type="hidden" name="_method" value="PUT">
                    @endisset
                    <div class="mb-3">
                        <label for="inputСabinetNumber" class="form-label">Номер кабинета:</label>
                        <input type="number" maxlength="3" name="cabinetNumber" class="form-control @error('cabinetNumber') is-invalid @enderror" id="inputCabinetNumber" placeholder="номер кабинета: 111" aria-describedby="invalidInputСabinetNumber" value="{{ old('cabinetNumber') }}">
                        @error('cabinetNumber') <div id="invalidInputСabinetNumber" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Наименование:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Наименование роли: Пользователь" aria-describedby="invalidInputName" value="{{ old('name') }}">
                        @error('name') <div id="invalidInputName" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputEN_name" class="form-label">Английское наименование:</label>
                        <input type="text" name="EN_name" class="form-control @error('EN_name') is-invalid @enderror" id="inputEN_name" placeholder="User" aria-describedby="invalidInputEN_name" value="{{ old('EN_name') }}">
                        @error('EN_name') <div id="invalidInputEN_name" class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($cabinet))
                            Отредактировать кабинет
                        @else
                            Создать новый кабинет
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection

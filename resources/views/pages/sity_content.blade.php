@extends('base')
@section('content')
    <h4>Города</h4>
    <p class="text-break">
        @foreach ($sities as $one_sity)
            <a href="{{ env('APP_URL') }}{{$one_sity->name_en}}"  style="margin-left:15px;">
                {{ $one_sity->name_ru }}
            </a>
        @endforeach
    </p>
@endsection

<header class="py-3 border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <ul class="list-unstyled d-flex">
                    <li class="me-3">
                        @if(session('sity'))
                            {{ session('sity_ru') }}
                        @else
                            Город не выбран
                        @endif
                    </li>
                    <li class="me-3">
                        <a href="{{ route('session_reset') }}">
                            Сбросить сессию
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3">

                        @if(session('sity'))
                            <a href="{{ env('APP_URL') }}{{ session('sity') }}" }}>
                                Главная
                            </a>
                        @else
                            <a href="{{ route('main_without_session') }}">
                                Главная
                            </a>
                        @endif

                    </li>
                    <li class="ms-3">

                        @if(session('sity'))
                            <a href="{{ env('APP_URL') }}{{ session('sity') }}/about">
                                О нас
                            </a>
                        @else
                            <a href="{{ route('about_without_session') }}">
                                О нас
                            </a>
                        @endif


                    </li>
                    <li class="ms-3">
                        @if(session('sity'))
                            <a href="{{ env('APP_URL') }}{{ session('sity') }}/news">
                                Новости
                            </a>
                        @else
                            <a href="{{ route('news_without_session') }}">
                                Новости
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

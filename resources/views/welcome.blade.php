<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .element{
                float: left;
            }
            .fila{
                display: grid;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Consumo de API
                </div>

                <div class="links">
                    <p>
                        <b>/obtener_arreglo</b> -> n_dimensiones(INT): Retorna el arreglo de elementos segun la cantidad de dimensiones solicitada.<br>
                        <b>/reordenar_horario</b> -> arreglo(INT): Retorna el arreglo ordenado en sentido HORARIO.<br>
                        <b>/reordenar_antihorario</b> -> arreglo(INT): Retorna el arreglo ordenado en sentido ANTIHORARIO.<br>
                    </p>
                </div>
                <div id="app">
                    <h1>Arreglo mostrado</h1>
                    <p>
                        Si cambia el valor numerico del campo input, podrá redimensionar el arreglo.
                    </p>
                  <section v-if="errored">
                    <p>Lo sentimos, no es posible obtener la información en este momento, por favor intente nuevamente mas tarde</p>
                  </section>

                  <section v-else>
                    <div v-if="loading">Cargando...</div>

                    <div>
                        <input v-model="dimensiones" placeholder="N° elementos por fila" v-on:change="load">
                        <button v-on:click="rotate1">Rotar horario</button>
                        <button v-on:click="rotate2">Rotar antihorario</button>
                        <table border="1">
                            <tr v-for="(arr, index) in arreglo">
                                <td class="element" v-for="(ele, index) in arr">
                                    <span>@{{ele}}</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                  </section>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>

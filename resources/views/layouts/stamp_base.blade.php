<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <title>@yield('title')</title>

    </head>

    <body>
        <div class="content d-flex">
            <div class="main text-center">
                @yield('schoolname')
                <p id="RealtimeClockArea">00:00:00</p>
                <script type="text/javascript">
                    function set2fig(num) {
                        // 桁数が1桁だったら先頭に0を加えて2桁に調整する
                        var ret;
                        if (num < 10) {
                            ret = "0" + num;
                        } else {
                            ret = num;
                        }
                        return ret;
                    }

                    function showClock2() {
                        var nowTime = new Date();
                        var nowHour = set2fig(nowTime.getHours());
                        var nowMin = set2fig(nowTime.getMinutes());
                        var nowSec = set2fig(nowTime.getSeconds());
                        var msg = nowHour + ":" + nowMin + ":" + nowSec;
                        document.getElementById("RealtimeClockArea").innerHTML = msg;
                    }
                    setInterval('showClock2()', 1000);

                </script>
            </div>
            <div class="side d-flex">
                @yield('userslist')
                @yield('paginate')

            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>

</html>

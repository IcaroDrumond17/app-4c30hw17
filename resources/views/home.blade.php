<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Teste Appmax - Ícaro Drumond </title>
    <style type="text/css">
        body {
            background: #233046;
            padding: 5%;
        }

        .card {
            padding: 5%;
        }

        #p_id,
        #p_name,
        #p_sku,
        #p_stock {
            text-align: center;
        }

        #p_movements {
            text-align: justify;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        ul li {
            margin: 1px 0 0 10px;
            list-style-type: none;
        }

        .square-one,
        .square-two {
            position: absolute;
            opacity: 0.4;
            z-index: 9999;
            max-width: 300px;
            padding: 30px;
            border-radius: 25px;
            border: 6px solid;
            box-shadow: 4px 4px 10px black;
        }

        .square-one {
            top: 5vh;
            left: 94vw;
            transform: translate(-50%, -40%);
            border-color: #9b6afa;
        }

        .square-two {
            top: 12vh;
            left: 90vw;
            transform: translate(-50%, -60%);
            border-color: #27c4d8;
        }

        @media only screen and (min-width : 576px) {

            .square-one,
            .square-two {
                padding: 40px;
            }

            .square-one {
                top: 6vh;
            }

            .square-two {
                top: 14vh;
            }
        }

        @media only screen and (min-width : 768px) {

            .square-one,
            .square-two {
                padding: 45px;
            }
        }

        @media only screen and (min-width : 992px) {

            .square-one,
            .square-two {
                padding: 50px;
                border-radius: 30px;
            }
        }

        @media only screen and (min-width : 1200px) {

            .square-one,
            .square-two {
                padding: 60px;
                border-radius: 35px;
            }

            .square-one {
                top: 8vh;
            }

            .square-two {
                top: 16vh;
            }
        }

        @media only screen and (min-width : 1400px) {

            .square-one,
            .square-two {
                padding: 70px;
                border-radius: 40px;
            }
        }

        @media only screen and (min-width : 1600px) {

            .square-one,
            .square-two {
                padding: 75px;
            }
        }

    </style>
</head>

<body>
    <div class="square-one"></div>
    <div class="square-two"></div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-title">
                <h5 class="card-title">Produtos - Appmax</h5>
                <h6 class="card-subtitle mb-2 text-muted">Teste Appmax - Ícaro Drumond</h6>
            </div>
            <div class="card-body">
                @if (count($data) > 0)
                    <div class="table-responsive-sm">
                        <table
                            class="table table-sm table-striped table-hover table-bordered border-secondary align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>SKU</th>
                                    <th>Estoque</th>
                                    <th>Movimentações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th id="p_id">{{ $item['id'] }}</th>
                                        <td id="p_name">{{ $item['nome'] }}</td>
                                        <td id="p_sku">{{ $item['SKU'] }}</td>
                                        <td id="p_stock">{{ $item['quantidade'] }}</td>
                                        <td id="p_movements">
                                            @isset($item['movements'])
                                                @if ($item['movements'])
                                                    <ul>
                                                        @foreach ($item['movements']['movements'] as $m)
                                                            <li> {{ $m['message'] }} - {{ $m['updated'] }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-secondary" role="alert">
                        Não existem produtos cadastrados no momento.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div style="margin: 10px auto; width:100%; text-align: center; color: #fff">
        <p>Created By Ícaro Drumond</p>
        <small>Web Development and Bachelor of Computer Science</small>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>

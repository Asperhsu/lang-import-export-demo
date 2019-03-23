<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tranlation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Groups</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav nav-pills" role="tablist">
                @foreach ($groups as $group => $trans)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="pill" href="#trans-{{ $group }}" role="tab">
                        {{ $group }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div class="m-3">
        <form method="post" action="{{ route('translation.store') }}">
            <div class="tab-content" id="pills-tabContent">
                @foreach ($groups as $group => $trans)
                <div class="tab-pane {{ $loop->first ? 'show active' : '' }}" id="trans-{{ $group }}" role="tabpanel">
                    <table class="table table-hover table-bordered table-sm ">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2">Key</th>
                                <th class="text-center" colspan="{{ count(head($trans)) }}">Locales</th>
                            </tr>
                            <tr>
                                @foreach (array_keys(head($trans)) as $locale)
                                <th>{{ $locale }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trans as $key => $locales)
                            <tr>
                                <td>{{ $key }}</td>
                                @foreach ($locales as $locale => $text)
                                <td><input type="text" class="form-control form-control-sm" name="trans[{{ implode('.', [$group, $locale, $key]) }}]" value="{{ $text }}"></td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>

            <div class="text-right">
                <button type="submit" class="pull-right btn btn-primary">Save</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lang-Excel Import/Export</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
</head>
<body>
    <div class="container p-3">
        @if (session('msg'))
        <div class="alert alert-primary" role="alert">
            {{ session('msg') }}
        </div>
        @php session()->forget('msg'); @endphp
        @endif

        <div class="row">
            <div class="col-3">
                <div class="card" id="files">
                    <div class="card-header d-flex align-items-center">
                        Langs
                        <button class="ml-auto btn btn-sm btn-success"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="card-body">
                        <ul v-if="files.length">
                            <li v-for="file in files" :key="file" v-text="file"></li>
                        </ul>
                        <div class="text-center card-title" v-else>No File</div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{ route('lang.clear') }}" class="mb-1">
                            <button class="btn btn-sm btn-block btn-danger" type="submit">Clear Lang Directory</button>
                        </form>
                        <form method="POST" action="{{ route('lang.download') }}" class="mb-1">
                            <button class="btn btn-sm btn-block btn-info" type="submit">Zip Lang Directory</button>
                        </form>
                        <a href="{{ route('translation.index') }}" class="btn btn-sm btn-block btn-success">Edit Lang</a>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="card mb-4">
                    <div class="card-header">Upload PHP Lang Files to XLS</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Lang</span>
                            </div>
                            <input type="text" id="lang" class="form-control" value="tw">
                        </div>
                        <form action="{{ route('export.upload') }}" class="dropzone" id="lang-dropzone"></form>
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{ route('export.download') }}">
                            <button class="btn btn-block btn-primary">Export</button>
                        </form>
                    </div>
                </div>

                <form method="POST" action="{{ route('import.upload') }}" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">Import XLSX to PHP Lang Files</div>
                        <div class="card-body">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose xlsx</label>
                            </div>
                            @if ($errors->has('file'))
                                <div class="text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-block btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="https://github.com/Asperhsu/lang-import-export-demo" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#FD6C6C; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script>
        Dropzone.options.langDropzone = {
            acceptedFiles: ".php",
            init: function() {
                this.on("sending", function(file, xhr, formData){
                    formData.append("lang", document.querySelector('#lang').value);
                });
                this.on("success", function(file, res){
                    console.log(file, res);
                    files.update();
                });
            }
        };

        let files = new Vue({
            el: '#files',
            data: { files: [] },
            mounted () { this.update(); },
            methods: {
                update () {
                    fetch("{{ route('files') }}")
                        .then(res => res.json())
                        .then(files => this.files = files)
                        .catch(error => console.error('Error:', error));
                }
            },
        })
    </script>
</body>
</html>
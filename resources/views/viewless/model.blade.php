@extends(admin_template('viewless.layout'))

@section('content')
    <div id="app">
        {!! $contents !!}
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    lists: {
                        pageable: false,
                    },
                }
            },
            methods: {}
        })
    </script>
@endsection

@section('style')

@endsection
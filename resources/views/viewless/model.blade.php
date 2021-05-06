@extends(admin_template('viewless.layout'))

@section('content')
    <div id="app">
        {!! $contents !!}
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    controller: @json($baseData['controllerName']),
                    lists: @json($configs['lists']),
                    data: @json($data),
                    formData: @json($configs['formData']),
                    dialog: @json($configs['dialog']),
                }
            },
            methods: {
                onAddButtonClick() {
                    this.dialog.visible = true
                },
                onRefreshButtonClick() {
                    this.refreshLists()
                },
                refreshLists() {
                    this.$http.get(this.controller + '/lists', {
                        label: 'refresh',
                        params: {
                            pageable: this.lists.pageable,
                            page: this.lists.page,
                            size: this.lists.size,
                        }
                    }).then(res => {
                        this.lists = res.data.lists
                    })
                },
            }
        })
    </script>
@endsection

@section('style')

@endsection
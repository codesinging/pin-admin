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
            computed: {
                dialogFullscreenIcon() {
                    return 'bi ' + (this.dialog.fullscreen ? 'bi-fullscreen-exit' : 'bi-fullscreen')
                },
                onDialogZoomOutDisabled() {
                    return this.dialog.width >= 100
                },
                onDialogZoomInDisabled() {
                    return this.dialog.width <= 40
                },
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
                onFormSubmit() {

                },
                onDialogFullscreen() {
                    this.dialog.fullscreen = !this.dialog.fullscreen
                },
                onDialogZoomOut() {
                    this.dialog.width = Math.min(this.dialog.width + 20, 100)
                },
                onDialogZoomIn() {
                    this.dialog.width = Math.max(this.dialog.width - 20, 40)
                },
            }
        })
    </script>
@endsection

@section('style')

@endsection
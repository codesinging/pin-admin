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
                    defaults: @json($configs['defaults']),
                    dialog: @json($configs['dialog']),
                    formData: null,
                    isEdit: false,
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
                    this.isEdit = false,
                        this.dialog.visible = true
                    this.dialog.title = '新增'
                    this.formData = Object.assign({}, this.defaults)
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
                    this.$refs.form.validate(valid => {
                        if (valid) {
                            if (this.formData.id) {
                                this.$put(this.controller + '/' + this.formData.id, this.formData, {label: 'submit'}).then(res => {
                                    this.refreshLists()
                                    this.dialog.visible = false
                                })
                            } else {
                                this.$post(this.controller, this.formData, {label: 'submit'}).then(res => {
                                    this.refreshLists()
                                    this.dialog.visible = false
                                })
                            }
                        } else {
                            this.$message.warning('表单验证失败，请重试')
                        }
                    })
                },
                onDialogFullscreen() {
                    this.dialog.fullscreen = !this.dialog.fullscreen
                },
                onDialogZoomOut() {
                    this.dialog.width = Math.min(this.dialog.width + 20, 100)
                    this.dialog.top = this.dialog.top - 5
                },
                onDialogZoomIn() {
                    this.dialog.width = Math.max(this.dialog.width - 20, 40)
                    this.dialog.top = this.dialog.top + 5
                },
                onDialogClosed() {
                    this.$refs.form.clearValidate()
                },
                onEditItem(scope) {
                    this.isEdit = true
                    this.dialog.visible = true
                    this.dialog.title = '编辑'
                    this.formData = Object.assign({}, scope.row)
                },
                onDeleteItem(scope) {
                    this.$confirm('删除后无法恢复，确定要删除吗？', '提示', {
                        type: 'warning',
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                    }).then(() => {
                        this.$delete('admin_users/' + scope.row.id, {label: 'delete_' + scope.row.id}).then(res => {
                            this.refreshLists()
                        })
                    }).catch(() => {
                        this.$message.info('取消删除操作')
                    })
                },
            },
            created() {
                this.refreshLists()
            }
        })
    </script>
@endsection

@section('style')

@endsection
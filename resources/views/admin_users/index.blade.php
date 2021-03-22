@extends(admin_template('layouts.app'))

@section('content')
    <div id="app">
        <div class="flex items-center justify-between">
            <div class="space-x-2">
                <el-button @click="onAddButtonClick" type="primary" icon="el-icon-plus">添加</el-button>
                <el-button @click="onRefreshButtonClick" :loading="state.refresh" icon="el-icon-refresh">刷新</el-button>
            </div>
        </div>

        <el-table :data="lists.data" v-loading="state.refresh" border class="mt-3">
            <el-table-column type="selection" align="center"></el-table-column>
            <el-table-column prop="id" label="ID" width="80" align="center"></el-table-column>
            <el-table-column prop="mobile" label="手机号码" align="center"></el-table-column>
            <el-table-column prop="name" label="用户名称" align="center"></el-table-column>
            <el-table-column prop="status" label="状态" align="center" width="100">
                <template #default="scope">
                    <el-switch v-model="scope.row.status" @change="onUpdate(scope.row, 'sort')" size="mini" :disabled="state['status_'+scope.row.id]" v-loading="state['status_'+scope.row.id]"></el-switch>
                </template>
            </el-table-column>
            <el-table-column label="操作" align="center">
                <template #default="scope">
                    <div class="space-x-2">
                        <el-button @click="onEditButtonClick(scope.row)" type="primary" size="mini" icon="el-icon-edit">修改</el-button>
                        <el-button @click="onDelete(scope.row)" :loading="state['delete_'+scope.row.id]" type="danger" size="mini" icon="el-icon-delete">删除</el-button>
                    </div>
                </template>
            </el-table-column>
        </el-table>

        <div class="bg-gray-50 p-2 mt-3">
            <el-pagination
                    background
                    :layout="lists.pageable ? 'total, prev, pager, next, jumper' : 'total, prev, pager, next'"
                    :total="lists.total"
                    :current-page.sync="lists.page"
                    :page-size.sync="lists.size"
                    @size-change="onPaginationSizeChange"
                    @current-change="onPaginationCurrentChange"
            >
            </el-pagination>
        </div>

        <el-dialog v-model="editDialog.visible" width="50%" @opened="onEditDialogOpened">

            <el-form ref="form" :model="formData" :rules="formRules[formMode]" :disabled="state.save" label-position="top">

                <el-form-item prop="mobile" label="手机号码">
                    <el-input v-model="formData.mobile" placeholder="手机号码"></el-input>
                </el-form-item>

                <el-form-item prop="name" label="用户名称">
                    <el-input v-model="formData.name" placeholder="用户名称"></el-input>
                </el-form-item>

                <el-form-item prop="password" label="登录密码">
                    <el-input v-model="formData.password" placeholder="登录密码" show-password></el-input>
                </el-form-item>

            </el-form>

            <template #title><i class="el-icon-edit"></i> 编辑</template>

            <template #footer>
                <div class="flex items-center justify-between">
                    <div></div>
                    <div class="space-x-2">
                        <el-button @click="editDialog.visible = false">取消</el-button>
                        <el-button type="primary" @click="onSave" :loading="state.save">保存</el-button>
                    </div>
                </div>
            </template>
        </el-dialog>
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    formMode: 'add',
                    formData: {},
                    formRules: {
                        add: {
                            mobile: [
                                {required: true, message: '手机号码不能为空', trigger: 'blur'},
                            ],
                            name: [
                                {required: true, message: '用户名称不能为空', trigger: 'blur'},
                            ],
                            password: [
                                {required: true, message: '登录密码不能为空', trigger: 'blur'},
                            ],
                        },
                        edit: {
                            mobile: [
                                {required: true, message: '手机号码不能为空', trigger: 'blur'},
                            ],
                            name: [
                                {required: true, message: '用户名称不能为空', trigger: 'blur'},
                            ],
                        }
                    },
                    lists: {
                        pageable: false,
                    },
                    editDialog: {
                        visible: false,
                    },
                }
            },
            methods: {
                onAddButtonClick() {
                    this.formMode = 'add'
                    this.formData = {}
                    this.editDialog.visible = true
                },
                onEditButtonClick(row) {
                    this.formMode = 'edit'
                    this.editDialog.visible = true
                    this.formData = Object.assign({}, row)
                },
                onEditDialogOpened() {
                    this.$refs.form.clearValidate()
                },
                onRefreshButtonClick() {
                    this.refreshLists()
                },
                refreshLists() {
                    this.$http.get('admin_users/lists', {
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
                onSave() {
                    this.$refs.form.validate(valid => {
                        if (valid) {
                            if (this.formMode === 'add') {
                                this.$http.post('admin_users', this.formData, {label: 'save'}).then(res => {
                                    this.refreshLists()
                                    this.editDialog.visible = false
                                })
                            } else {
                                this.$http.put('admin_users/' + this.formData.id, this.formData, {label: 'save'}).then(res => {
                                    this.refreshLists()
                                    this.editDialog.visible = false
                                })
                            }
                        } else {
                            this.$message.warning('表单验证失败，请重新填写。')
                        }
                    })
                },
                onDelete(row) {
                    this.$confirm('删除后无法恢复，确定要删除吗？', '提示', {
                        type: 'warning',
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                    }).then(()=>{
                        this.$http.delete('admin_users/' + row.id, {label: 'delete_' + row.id}).then(res => {
                            this.refreshLists()
                        })
                    }).catch(()=>{
                        this.$message.info('取消删除操作')
                    })
                },
                onUpdate(row, label) {
                    this.$http.put('admin_users/' + row.id, row, {label: label + '_' + row.id}).then(res => {
                        this.refreshLists()
                    })
                },
                onPaginationSizeChange() {
                    this.refreshLists()
                },
                onPaginationCurrentChange() {
                    this.refreshLists()
                },
            },

            mounted() {
                this.refreshLists()
            },
        })
    </script>
@endsection

@section('style')

@endsection
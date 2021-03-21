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
            <el-table-column prop="tree.name" label="名称" class-name="font-mono"></el-table-column>
            <el-table-column prop="url" label="地址"></el-table-column>
            <el-table-column prop="icon" label="图标" align="center" width="80">
                <template #default="scope"><i v-if="scope.row.icon" :class="scope.row.icon"></i></template>
            </el-table-column>
            <el-table-column prop="sort" label="排列序号" align="center" width="132">
                <template #default="scope">
                    <el-input-number v-model="scope.row.sort" @change="onUpdate(scope.row, 'sort')" size="mini" v-loading="state['sort_'+scope.row.id]"></el-input-number>
                </template>
            </el-table-column>
            <el-table-column prop="status" label="状态" align="center" width="100">
                <template #default="scope">
                    <el-switch v-model="scope.row.status" @change="onUpdate(scope.row, 'sort')" size="mini" :disabled="state['status_'+scope.row.id]" v-loading="state['status_'+scope.row.id]"></el-switch>
                </template>
            </el-table-column>
            <el-table-column prop="is_opened" label="是否展开" align="center" width="100">
                <template #default="scope">
                    <el-switch v-if="scope.row.tree.children.length>0" v-model="scope.row.is_opened" @change="onUpdate(scope.row, 'open')" size="mini" :disabled="state['open_'+scope.row.id]"
                               v-loading="state['open_'+scope.row.id]"></el-switch>
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

            <el-form ref="form" :model="formData" :rules="formRules[formMode]" label-position="top">

                <el-form-item label="上级菜单" prop="parent_id">
                    <el-select v-model="formData.parent_id" placeholder="选择上级菜单">
                        <el-option label="做为顶级菜单" :value="0"></el-option>
                        <el-option v-for="menu in lists.data" :disabled="menu.parent_id>0 || menu.id===formData.id" :key="menu.id" :label="menu.tree.name" :value="menu.id"></el-option>
                    </el-select>
                </el-form-item>

                <el-form-item prop="name" label="名称">
                    <el-input v-model="formData.name" placeholder="用户名称"></el-input>
                </el-form-item>

                <el-form-item prop="url" label="地址">
                    <el-input v-model="formData.url" placeholder="地址"></el-input>
                </el-form-item>

                <el-form-item prop="icon" label="图标">
                    <el-input v-model="formData.icon" placeholder="图标">
                        <template v-if="formData.icon" slot="append"><i :class="formData.icon"></i></template>
                    </el-input>
                </el-form-item>

                <el-form-item prop="sort" label="排列序号">
                    <el-input-number v-model="formData.sort" placeholder="排列序号"></el-input-number>
                </el-form-item>
            </el-form>

            <template #title><i class="el-icon-edit"></i> 编辑菜单</template>

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
                            name: [
                                {required: true, message: '名称不能为空', trigger: 'blur'},
                            ],
                        },
                        edit: {
                            name: [
                                {required: true, message: '名称不能为空', trigger: 'blur'},
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
                    this.$http.get('admin_menus/lists', {
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
                                this.$http.post('admin_menus', this.formData, {label: 'save'}).then(res => {
                                    this.refreshLists()
                                    this.editDialog.visible = false
                                })
                            } else {
                                this.$http.put('admin_menus/' + this.formData.id, this.formData, {label: 'save'}).then(res => {
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
                        this.$http.delete('admin_menus/' + row.id, {label: 'delete_' + row.id}).then(res => {
                            this.refreshLists()
                        })
                    }).catch(()=>{
                        this.$message.info('取消删除操作')
                    })
                },
                onUpdate(row, label) {
                    this.$http.put('admin_menus/' + row.id, row, {label: label + '_' + row.id}).then(res => {
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
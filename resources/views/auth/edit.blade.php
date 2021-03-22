@extends(admin_template('layouts.app'))

@section('content')
    <div id="app">
        <el-card>
            <template #header>
                <div class="flex items-center justify-between">
                    <span>编辑</span>
                </div>
            </template>

            <el-form ref="form" :model="formData" :rules="formRules" :disabled="state.loading" label-position="top">

                <el-form-item prop="mobile" label="手机号码">
                    <el-input v-model="formData.mobile" placeholder="手机号码" disabled></el-input>
                </el-form-item>

                <el-form-item prop="name" label="用户名称">
                    <el-input v-model="formData.name" placeholder="用户名称"></el-input>
                </el-form-item>

                <el-form-item prop="password" label="登录密码">
                    <el-input v-model="formData.password" placeholder="登录密码" show-password></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button @click="onReset">重置</el-button>
                    <el-button type="primary" @click="onSave" :loading="state.loading">保存</el-button>
                </el-form-item>

            </el-form>
        </el-card>
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    formData: @json($baseData['adminUser']),
                    formRules: {
                        mobile: [
                            {required: true, message: '手机号码不能为空', trigger: 'blur'},
                        ],
                        name: [
                            {required: true, message: '用户名称不能为空', trigger: 'blur'},
                        ],
                    },
                }
            },
            methods: {
                onReset() {
                    this.$refs.form.resetFields()
                },
                onSave() {
                    this.$refs.form.validate(valid => {
                        if (valid) {
                            this.$http.put('auth/update', this.formData).then(res => {

                            })
                        } else {
                            this.$message.warning('表单验证失败，请重新填写。')
                        }
                    })
                }
            }
        })
    </script>
@endsection

@section('style')

@endsection
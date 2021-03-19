@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full flex items-center justify-center">

        <particles-js></particles-js>

        <el-card class="w-120 z-10" @keyup.enter="onSubmit">
            <template #header>
                <div class="text-lg">用户登录</div>
            </template>

            <el-form ref="form" :model="user" :disabled="state.loading || state.redirecting">
                <el-form-item prop="name">
                    <el-input v-model="user.mobile" placeholder="请输入手机号码">
                        <template #prepend>
                            <div class="w-16">登录账号</div>
                        </template>
                    </el-input>
                </el-form-item>

                <el-form-item prop="password">
                    <el-input v-model="user.password" placeholder="请输入登录密码" show-password>
                        <template #prepend>
                            <div class="w-16">登录密码</div>
                        </template>
                    </el-input>
                </el-form-item>

                <div class="flex">
                    <el-button type="primary" class="w-full" @click="onSubmit" :loading="state.loading">登录</el-button>
                </div>
            </el-form>
        </el-card>
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    user: {
                        mobile: '13838017968',
                        password: 'admin123',
                    },
                    rules: {
                        mobile: [
                            {required: true, message: '登录账号不能为空', trigger: 'blur'},
                        ],
                        password: [
                            {required: true, message: '登录密码不能为空', trigger: 'blur'},
                        ],
                    }
                }
            },
            methods: {
                onSubmit(){
                    this.$refs.form.validate(valid=>{
                        if (valid){
                            this.$http.post('auth/login', this.user).then(res=>{
                                this.setTrue('redirecting')
                                setTimeout(()=>{
                                    location.href = baseUrl
                                }, 1000)
                            })
                        } else {
                            this.$message.warning('表单验证未通过，请重新填写。')
                        }
                    })
                }
            }
        })
    </script>
@endsection

@section('style')
    <style>
        html, body {
            height: 100%;
        }
    </style>
@endsection
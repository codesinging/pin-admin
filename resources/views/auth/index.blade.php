@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full flex items-center justify-center">

        <particles-js></particles-js>

        <el-card class="w-120 z-10" @keyup.enter="onSubmit">
            <template #header>
                <div class="text-lg">用户登录</div>
            </template>

            <el-form ref="form" :model="user" :disabled="state.loading || state.redirecting">
                <el-form-item prop="name" :rules="rules.name">
                    <el-input v-model="user.mobile" placeholder="请输入手机号码">
                        <template #prepend>
                            <div class="w-16">登录账号</div>
                        </template>
                    </el-input>
                </el-form-item>

                <el-form-item prop="password" :rules="rules.password">
                    <el-input v-model="user.password" placeholder="请输入登录密码" show-password>
                        <template #prepend>
                            <div class="w-16">登录密码</div>
                        </template>
                    </el-input>
                </el-form-item>

                <el-form-item prop="captcha" v-if="useCaptcha" :rules="rules.captcha">
                    <el-input v-model="user.captcha" class="captcha-input">
                        <template #prepend>
                            <div class="w-16">验证码</div>
                        </template>
                        <template #append>
                            <div class="flex items-center justify-center" @click="onRefreshCaptcha">
                                <el-image :src="captchaSrc" class="w-32 h-8 leading-8 cursor-pointer text-center">
                                    <template #placeholder>
                                        <i class="el-icon-loading"></i>
                                    </template>
                                </el-image>
                            </div>
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
        let captchaSrc = "{{ admin_config('captcha') ? $captchaSrc : '' }}"
        let app = createApp('#app', {
            data() {
                return {
                    user: {
                        mobile: '13838017968',
                        password: 'admin123',
                        captcha: '',
                    },
                    rules: {
                        mobile: [
                            {required: true, message: '登录账号不能为空', trigger: 'blur'},
                        ],
                        password: [
                            {required: true, message: '登录密码不能为空', trigger: 'blur'},
                        ],
                        captcha: [
                            {required: true, message: '验证码不能为空', trigger: 'blur'},
                        ],
                    },
                    useCaptcha: @json(admin_config('captcha')),
                    captchaSrc: '{{ $captchaSrc }}',
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
                },
                refreshCaptcha() {
                    this.setFalse('captchaLoaded')
                    this.captchaSrc = captchaSrc + (new Date()).getTime()
                },
                onRefreshCaptcha() {
                    this.refreshCaptcha()
                },
            }
        })
    </script>
@endsection

@section('style')
    <style>
        html, body {
            height: 100%;
        }

        .captcha-input .el-input-group__append{
            padding: 1px !important;
            min-width: 120px;
        }
    </style>
@endsection
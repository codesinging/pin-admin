@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="overflow-x-hidden">
        <el-row :gutter="20">
            <el-col :span="12">
                <el-card>
                    <template #header>
                        <span>用户信息</span>
                    </template>
                    <div class="divide-y divide-dashed divide-gray-200">
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">用户名称</span>
                            <span>@{{ user.name }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">手机号码</span>
                            <span>@{{ user.mobile }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">创建时间</span>
                            <span>@{{ user.created_at }}</span>
                        </div>
                    </div>
                </el-card>
            </el-col>

            <el-col :span="12">
                <el-card>
                    <template #header>
                        <span>系统信息</span>
                    </template>
                    <div class="divide-y divide-dashed divide-gray-200">
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">PHP</span>
                            <span>v{{ PHP_VERSION }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">Laravel</span>
                            <span>v{{ app()->version() }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-500">PinAdmin</span>
                            <span>v{{ admin()->version() }}</span>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    user: @json($baseData['adminUser'])
                }
            },
            methods: {}
        })
    </script>
@endsection

@section('style')

@endsection
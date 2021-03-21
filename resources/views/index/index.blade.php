@extends(admin_template('layouts.app'))

@section('content')
    <div id="app" class="h-full">
        <el-container class="h-full">
            <el-aside class="h-full bg-gray-700 transition-all duration-300 ease-in-out" :width="asideWidth">
                <div class="flex items-center justify-center bg-gray-900 space-x-2 px-3 py-3.5 overflow-hidden">
                    <img src="{{ admin_asset('images/pinfan-logo-white.svg') }}" alt="PinFan Logo" class="h-8">
                    <img src="{{ admin_asset('images/pinfan-admin-logo-white.svg') }}" alt="PinFan Logo" class="h-6" v-show="!collapsed">
                </div>

                <el-menu :collapse="collapsed" :default-active="activeMenuId" :default-openeds="openedMenuIds" background-color="#374152" text-color="#ffffff" @select="onMenuSelect">
                    <template v-for="menu in menusTree" :key="menu.id">
                        <el-submenu v-if="menu.children" :index="menu.id.toString()">
                            <template #title>
                                <i :class="menu.icon || 'bi-chevron-right'"></i>
                                <span>@{{ menu.name }}</span>
                            </template>
                            <el-menu-item v-for="submenu in menu.children" :key="submenu.id" :index="submenu.id.toString()">
                                <i :class="submenu.icon || 'bi-chevron-double-right'"></i>
                                <template #title>@{{ submenu.name }}</template>
                            </el-menu-item>
                        </el-submenu>
                        <el-menu-item v-else :index="menu.id.toString()">
                            <i :class="menu.icon || 'bi-chevron-right'"></i>
                            <template #title>@{{ menu.name }}</template>
                        </el-menu-item>
                    </template>
                </el-menu>
            </el-aside>
            <el-container>
                <el-header class="flex items-center justify-between bg-gray-200">
                    <div class="flex items-center space-x-2">
                        <el-tooltip :content="collapsed ? '展开菜单' : '收缩菜单'">
                            <div @click="collapsed = !collapsed" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 text-gray-600 hover:text-white cursor-pointer">
                                <i :class="[collapsed ? 'bi-arrow-bar-right' : 'bi-arrow-bar-left']"></i>
                            </div>
                        </el-tooltip>

                        <el-tooltip :content="fullscreen ? '退出全屏' : '全屏显示'">
                            <div @click="onFullscreenToggle" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 text-gray-600 hover:text-white cursor-pointer">
                                <i :class="[fullscreen ? 'bi-fullscreen-exit' : 'bi-fullscreen']"></i>
                            </div>
                        </el-tooltip>

                        <el-tooltip content="刷新页面">
                            <div @click="onMainPageReload" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 hover:bg-gray-400 text-gray-600 hover:text-white cursor-pointer">
                                <i class="bi-arrow-repeat text-xl"></i>
                            </div>
                        </el-tooltip>
                    </div>

                    <el-dropdown @command="onUserCommand">
                        <div class="el-dropdown-link flex items-center space-x-2 cursor-pointer">
                            <el-avatar :size="32" icon="el-icon-user"></el-avatar>
                            <span>@{{ user.name }}<i class="el-icon-arrow-down el-icon--right"></i></span>
                        </div>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <el-dropdown-item command="edit"><i class="el-icon-edit"></i>编辑信息</el-dropdown-item>
                                <el-dropdown-item command="logout"><i class="el-icon-switch-button"></i>注销登录</el-dropdown-item>
                            </el-dropdown-menu>
                        </template>
                    </el-dropdown>
                </el-header>

                <el-header v-if="tabs.length" class="mt-5" height="42px">
                    <el-tabs v-model="activeTabUid" type="card" @tab-remove="onTabRemove">
                        <el-tab-pane v-for="tab in tabs" :key="tab.uid" :label="tab.name" :name="tab.uid" :closable="!tab.is_home"></el-tab-pane>
                    </el-tabs>
                </el-header>

                <el-main>
                    <template v-for="(tab,index) in tabs" :key="index">
                        <main-frame :tab="tab" :ref="tab.uid" v-show="tab.uid === activeTabUid"></main-frame>
                    </template>
                </el-main>
            </el-container>
        </el-container>
    </div>

    <script>
        createApp('#app', {
            data() {
                return {
                    collapsed: false,
                    fullscreen: false,
                    user: @json($baseData['adminUser']),
                    menus: @json($adminMenus),
                    activeMenu: null,
                    openedMenuIds: [],
                    tabs: [],
                    activeTab: null,
                    activeTabUid: null,
                }
            },
            computed: {
                asideWidth() {
                    return this.collapsed ? '64px' : '240px'
                },

                menusMap() {
                    let map = {}
                    this.menus.forEach(menu => {
                        map[menu.id] = menu
                    })
                    return map
                },

                menusTree() {
                    let tree = []
                    this.menus.forEach(menu => {
                        let parent = this.menusMap[menu.parent_id]
                        if (parent) {
                            parent.children = parent.children || []
                            parent.children.push(menu)
                        } else {
                            tree.push(menu)
                        }
                    })
                    return tree
                },

                activeMenuId() {
                    return this.activeMenu ? this.activeMenu.id.toString() : null
                }
            },
            methods: {
                onMenuSelect(menuId) {
                    this.activeMenu = this.menusMap[menuId]
                    this.addTab(this.toTab(this.activeMenu))
                },

                toTab(menu) {
                    return {
                        mid: menu.id,
                        name: menu.name,
                        url: menu.url,
                        is_home: menu.is_home,
                        uid: 'u' + md5(menu.name + '|' + menu.url)
                    }
                },

                hasTab(tab) {
                    return this.tabs.findIndex(item => item.uid === tab.uid) > -1
                },

                addTab(tab) {
                    if (tab.url && tab.name) {
                        if (!this.hasTab(tab)) {
                            this.tabs.push(tab)
                        }
                        this.activateTab(tab)
                    }
                },

                activateTab(tab) {
                    this.activeTabUid = tab.uid
                },

                removeTab(tab) {
                    let index = this.tabs.findIndex(item => item.uid === tab.uid)

                    if (tab.is_home) {
                        return false
                    }

                    this.tabs.splice(index, 1)

                    if (tab.uid === this.activeTabUid) {
                        this.activateTab(this.tabs[index] || this.tabs[this.tabs.length - 1])
                    }
                },

                onFullscreenToggle() {
                    if (fullscreen.isEnabled) {
                        fullscreen.toggle().then(() => {
                            this.fullscreen = !this.fullscreen
                        })
                    }
                },

                onMainPageReload() {
                    if (this.activeTab) {
                        this.$refs[this.activeTab.uid].reload()
                    }
                },

                onTabRemove(tabUid) {
                    this.removeTab(this.tabs.find(tab => tab.uid === tabUid))
                },

                onUserCommand(command) {
                    switch (command) {
                        case 'logout':
                            this.userLogout()
                            break
                    }
                },

                userLogout() {
                    this.$http.get('auth/logout').then(() => {
                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    })
                },
            },
            created() {
                this.activeMenu = this.menus.find(menu => menu.is_home)
                this.openedMenuIds = this.menus.filter(menu => menu.is_opened).map(menu => menu.id.toString())
                this.addTab(this.toTab(this.activeMenu))
            },
            watch: {
                activeTabUid(tabUid) {
                    this.activeTab = this.tabs.find(tab => tab.uid === tabUid)
                    if (this.activeTab.mid) {
                        this.activeMenu = this.menus.find(menu => menu.id === this.activeTab.mid)
                    }
                },
            },
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
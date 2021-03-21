import {createApp} from 'vue'

import ElementPlus, {ElMessage} from 'element-plus'
import 'dayjs/locale/zh-cn'
import locale from 'element-plus/lib/locale/lang/zh-cn'

import state from "./utils/state"
import mixin from "./utils/mixin"
import http from "./utils/http"
import components from "./components"

window.md5 = require('blueimp-md5')
window.fullscreen = require('screenfull')

window.admin = {
    name: 'PinAdmin',
    message: ElMessage,
    state,
}

window.createApp = (element, App) => {
    const app = createApp(App)

    app.config.globalProperties.$http = http

    app.mixin(mixin)
    app.use(ElementPlus, {locale, size: 'medium'})

    Object.keys(components).forEach(component => {
        app.component(component, components[component])
    })

    app.mount(element)

    return app
}
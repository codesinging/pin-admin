import {createApp} from 'vue'
import ElementPlus, {ElMessage} from 'element-plus'
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

    app.mixin(mixin)
    app.use(ElementPlus)

    Object.keys(components).forEach(component => {
        app.component(component, components[component])
    })

    app.mount(element)

    app.config.globalProperties.$http = http

    return app
}
import axios from "axios"
import state from "./state"
import {ElMessage as message} from "element-plus"

const LOADING = 'loading'

axios.defaults.baseURL = baseUrl || ''
axios.defaults.withCredentials = true
axios.defaults.timeout = 10 * 1000
axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers['X-CSRF-TOKEN'] = csrfToken || ''

axios.interceptors.request.use(
    config => {
        state.setTrue(LOADING)
        if (config['label']) {
            state.setTrue(config['label'])
        }
        if (config['showMessage'] === undefined) {
            config['showMessage'] = true
        }

        return config
    },
    error => {
        message.error('网络请求错误')
        console.log('http.request.error', error.toJSON())

        return Promise.reject(error)
    }
)

axios.interceptors.response.use(
    response => {
        state.setFalse(LOADING)
        if (response.config['label']) {
            state.setFalse(response.config['label'])
        }

        if (response.status === 200) {
            if (response.data.code === 0) {
                if (response.config['showMessage']) {
                    message.success(response.data.message || '网络响应成功')
                }
                return response.data
            } else {
                if (response.config['showMessage']) {
                    message.error(response.data.message || '响应结果错误')
                }
                console.log('http.response.data.error', response)
            }
        } else {
            if (response.config['showMessage']) {
                message.error(response.data.message || '网络响应错误')
            }

            console.log('http.response.status.error', response)
        }

        return Promise.reject(response)
    },

    error => {
        state.setFalse(LOADING)
        if (error.config['label']) {
            state.setFalse(error.config.lang)
        }

        if (error.config['showMessage']) {
            let msg = error.response && error.response.data && error.response.data.errors
                ? Object.values(error.response.data.errors)[0][0]
                : (`[${error.response.status}]${error.response.statusText}` || '响应错误')
            message.error(msg)
        }
        console.log('http.response.error', error.toJSON())
        return Promise.reject(error)
    }
)

export default axios
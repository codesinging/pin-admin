import state from "./state"
import http from "./http"

export default {
    data() {
        return {
            state: state.state,
        }
    },

    methods: {
        setState(key, value) {
            state.set(key, value)
        },

        getState(key, def) {
            return state.get(key, def)
        },

        setTrue(key) {
            state.setTrue(key)
        },

        setFalse(key) {
            state.setFalse(key)
        },

        toggleState(key) {
            state.toggle(key)
        },

        $get(url, config) {
            return http.get(url, config)
        },

        $put(url, data, config) {
            return http.put(url, data, config)
        },

        $post(url, data, config){
            return http.post(url, data, config)
        },

        $delete(url, config){
            return http.delete(url, config)
        },
    }
}
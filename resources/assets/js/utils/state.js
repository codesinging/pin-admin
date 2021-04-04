import {reactive} from 'vue'

const state = reactive({})

const set = (key, value) => {
    state[key] = value
}

const get = (key, def) => {
    return state[key] === undefined ? def : state[key]
}

const setTrue = key => {
    set(key, true)
}

const setFalse = key => {
    set(key, false)
}

const toggle = key => {
    set(key, get(key, false))
}

export default {
    state,
    set,
    get,
    setTrue,
    setFalse,
    toggle,
}
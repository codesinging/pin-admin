<template>
    <div class="h-full overflow-hidden relative">
        <iframe v-show="loaded" ref="frame" :src="url" class="h-full w-full border-0"></iframe>
        <div v-show="!loaded" class="h-full flex items-center justify-center">
            <i class="el-icon-loading"></i>
        </div>
    </div>
</template>

<script>
export default {
    name: "MainFrame",
    props: {
        tab: Object,
    },
    data() {
        return {
            loaded: false,
        }
    },
    computed: {
        url() {
            return baseUrl + '/' + this.tab.url
        }
    },
    methods: {
        reload() {
            this.loaded = false
            this.$refs.frame.contentWindow.location.reload()
        },
        onLoaded() {
            this.loaded = true
        },
    },
    mounted() {
        this.$refs.frame.addEventListener('load', () => {
            this.loaded = true
        })
        window.addEventListener('message', (event) => {
            if (event.data.cmd === 'appMountedEvent') {
                this.loaded = true
            }
        })
    },
}
</script>

<style scoped>

</style>
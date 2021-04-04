<template>
    <div :id="id" class="particles-js" :style="styles"></div>
</template>

<script>
require('particles.js')
export default {
    name: "ParticlesJs",
    props: {
        number: {
            type: Number,
            default: 60,
        },
        color: {
            type: [String, Array],
            default: '#ffffff'
        },
        shapeType: {
            type: [String, Array],
            default: 'circle',
        },
        opacity: {
            type: Number,
            default: 0.5
        },
        size: {
            type: Number,
            default: 3,
        },
        speed: {
            type: Number,
            default: 6,
        },
        backgroundColor: {
            type: String,
            default: '#1a202d',
        },
        backgroundImage: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            configs: {}
        }
    },
    computed: {
        id() {
            return 'particles-js-' + Math.floor(Math.random() * 999999)
        },
        styles() {
            let styles = {}
            if (this.backgroundColor) {
                styles['background-color'] = this.backgroundColor
            }
            if (this.backgroundImage) {
                styles['background-image'] = `url(${this.backgroundImage})`
            }
            return styles
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.initParticles()
        })
    },
    methods: {
        initParticles() {
            window.particlesJS(this.id, {
                    "particles": {
                        "number": {
                            "value": this.number,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": this.color
                        },
                        "shape": {
                            "type": this.shapeType,
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            },
                            "polygon": {
                                "nb_sides": 5
                            },
                            "image": {
                                "src": "img/github.svg",
                                "width": 100,
                                "height": 100
                            }
                        },
                        "opacity": {
                            "value": this.opacity,
                            "random": false,
                            "anim": {
                                "enable": false,
                                "speed": 1,
                                "opacity_min": 0.1,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": this.size,
                            "random": true,
                            "anim": {
                                "enable": false,
                                "speed": 40,
                                "size_min": 0.1,
                                "sync": false
                            }
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": this.speed,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "bounce": false,
                            "attract": {
                                "enable": false,
                                "rotateX": 600,
                                "rotateY": 1200
                            }
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "grab"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        },
                        "modes": {
                            "grab": {
                                "distance": 140,
                                "line_linked": {
                                    "opacity": 1
                                }
                            },
                            "bubble": {
                                "distance": 400,
                                "size": 40,
                                "duration": 2,
                                "opacity": 8,
                                "speed": 3
                            },
                            "repulse": {
                                "distance": 200,
                                "duration": 0.4
                            },
                            "push": {
                                "particles_nb": 4
                            },
                            "remove": {
                                "particles_nb": 2
                            }
                        }
                    },
                    "retina_detect": true
                }
            )
        }
    }
}
</script>

<style scoped>
.particles-js {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
}
</style>
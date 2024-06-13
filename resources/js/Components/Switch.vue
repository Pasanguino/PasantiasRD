<template>
    <div class="switch-container">
        <div class="icon estudiante" :class="{ visible: !checked }">E</div>
        <label class="switch">
            <input type="checkbox" v-model="checked" @change="handleChange">
            <span class="slider round"></span>
        </label>
        <div class="icon organizacion" :class="{ visible: checked }">O</div>
    </div>
</template>

<script>
export default {
    name: 'Switch',
    props: {
        onEstudiante: {
            type: Function,
            required: true
        },
        onOrganizacion: {
            type: Function,
            required: true
        }
    },
    data() {
        return {
            checked: false
        };
    },
    methods: {
        handleChange() {
            if (this.checked) {
                this.onOrganizacion();
            } else {
                this.onEstudiante();
            }
        }
    }
};
</script>

<style scoped>
.switch-container {
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon {
    font-size: 24px;
    margin: 0 10px;
    opacity: 0;
    visibility: hidden;
}

.icon.visible {
    opacity: 1;
    visibility: visible;
}

.icon.estudiante {
    color: #FFA500;
    /* Color naranja para ESTUDIANTE */
}

.icon.organizacion {
    color: #FFD700;
    /* Color dorado para ORGANIZACIÓN */
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin: 0 10px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2196F3;
}

input:checked+.slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>

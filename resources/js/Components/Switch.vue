<template>
    <div class="switch-container">
        <input type="checkbox" id="switch" class="switch" v-model="isChecked">
        <label for="switch" class="switch-label">
            <span class="switch-icon" id="on-icon">🔆</span>
            <span class="switch-icon" id="off-icon">🌙</span>
        </label>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isChecked: false
        };
    },
    watch: {
        isChecked(newValue) {
            const onIcon = this.$refs.onIcon;
            const offIcon = this.$refs.offIcon;

            if (newValue) {
                onIcon.style.opacity = '1';
                offIcon.style.opacity = '0';
            } else {
                onIcon.style.opacity = '0';
                offIcon.style.opacity = '1';
            }
        }
    }
};
</script>

<style scoped>
.switch-container {
    position: relative;
    width: 60px;
    height: 34px;
}

.switch {
    opacity: 0;
    width: 0;
    height: 0;
}

.switch-label {
    position: absolute;
    cursor: pointer;
    background-color: #ccc;
    border-radius: 34px;
    width: 60px;
    height: 34px;
    transition: background-color 0.2s;
}

.switch-label:before {
    content: "";
    position: absolute;
    left: 4px;
    top: 4px;
    width: 26px;
    height: 26px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.2s;
}

.switch:checked+.switch-label {
    background-color: #66bb6a;
}

.switch:checked+.switch-label:before {
    transform: translateX(26px);
}

.switch-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
    transition: opacity 0.2s;
}

#on-icon {
    left: 8px;
    opacity: 0;
}

#off-icon {
    right: 8px;
    opacity: 1;
}

.switch:checked+.switch-label #on-icon {
    opacity: 1;
}

.switch:checked+.switch-label #off-icon {
    opacity: 0;
}
</style>

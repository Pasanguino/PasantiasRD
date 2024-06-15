<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700 text-left">
        <span class="texto" v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>

<style>
.texto {
    margin: 15px 15px 15px 0px;
    padding: 0;
    font-size: 18px;
    font-weight: bold;
    color:#BF5F07 ;
}

</style>


<template>
    <div>
        <select name="select" id="select-id" v-model="selected">
            <option v-for="(option, i) in arrayOptions" :key="i" :value="option">{{option.charAt(0).toUpperCase() + option.slice(1)}}</option>
        </select>
    </div>
</template>

<script setup>
import { reactive, ref, watch } from 'vue'


const props = defineProps({ arrayOptions: Array, selected: String })
const emit = defineEmits(['selectEvent'])

const selected = ref(props.selected)

watch(selected, async (newSelected, oldSelected) => {
    emit('selectEvent', {
        selected: selected.value
    })
})
</script>

<style>

</style>
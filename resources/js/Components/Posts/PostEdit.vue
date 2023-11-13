<template>
  <div class="h-screen fixed w-screen top-0 left-0 z-10 backdrop-blur-sm bg-slate/500 grid content-center">
    <div class="dark:bg-slate-800 bg-slate-200 p-4 md:w-[500] shadow-xl">
        <div class="flex justify-end">
            <button @click="emit('close')" class="px-4 py-1 border-2 border-blue-500 dark:border-white rounded-md">Close</button>
        </div>
        <form @submit.prevent="submit" class="mb-2">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="name" v-model="form.title" class="w-full" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" v-model="form.message" class="w-full" required></textarea><br><br>

            <h3>Type:</h3>
            <label for="news" class="mr-2">
                <input type="radio" id="news" name="news" v-model="form.type" value="news">News
            </label>
            <label for="update" class="mr-2">
                <input type="radio" id="update" name="update" v-model="form.type" value="update">Update
            </label>
            <label for="task" class="mr-2">
                <input type="radio" id="task" name="task" v-model="form.type" value="task">Task
            </label><br><br>
            <div class="flex justify-end">
                <button type="submit" class="px-8 py-1 border-2 border-blue-500 dark:border-white rounded-md">Update</button>
            </div>
        </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({ 
    post: Array
})

const emit = defineEmits(['close'])

const submit = () => {
  router.put('/posts/update', form)
  emit('close')
}

const form = reactive({
    id: props.post.id,
    title: props.post.title,
    message: props.post.message,
    type: props.post.type,
})

</script>

<style>

</style>
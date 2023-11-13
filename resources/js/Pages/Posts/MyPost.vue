<script setup>

import { reactive, ref, computed } from 'vue'
import { router, usePage, } from '@inertiajs/vue3'

import AppLayout from '@/Layouts/AppLayout.vue';
import PostShow from '@/Components/Posts/PostShow.vue';
import PostDelete from '@/Components/Posts/PostDelete.vue';
import PostAdd from '@/Components/Posts/PostAdd.vue';
import SelectForm from '@/Components/Forms/SelectForm.vue';

const props = defineProps({ 
    type: String,
    posts: Object
})

const page = usePage()
const user = computed(() => page.props.auth.user)

const state = reactive({
    isAddPost: false
});

const arrayOptions = ["all", "news", "update", "task"];

const selectPostType = (obj) => {
    router.get('/posts/my-posts/' + obj.selected, {user_id: user.value.id});
}

</script>

<template>
    <AppLayout title="Posts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <button v-if="state.isAddPost==false" @click="state.isAddPost = true" class="px-4 py-1 border-2 border-blue-500 dark:border-white rounded-md mb-4">Add Post</button>
                    <PostAdd v-if="state.isAddPost" @close="state.isAddPost = false"/>
                    <SelectForm :arrayOptions="arrayOptions" :selected="props.type" @selectEvent="selectPostType"/>
                    <PostShow :posts="props.posts"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
</style>

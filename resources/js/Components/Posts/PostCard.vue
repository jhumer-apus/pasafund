<template>
  <div class="dark:text-white border-l-2 dark:border-white border-blue-500 p-2">
    <div v-if="props.post.user_id == user.id" class="flex justify-end space-x-2 text-slate-600 dark:text-white">
      <button @click="state.isEdit=true" class="hover:text-blue-500">Edit</button>
      <button @click="state.isDelete = true" class="hover:text-red-500">Delete</button>
    </div>
    <div class="flex justify-between mb-2 dark:text-slate-400">
      <p>Posted by: {{props.post.first_name + " " + props.post.last_name}}</p>
      <p>{{postedDate(props.post.created_at)}}</p>
    </div>
    <div class="flex justify-between mb-2">
      <h2 class="text-2xl font-bold">{{props.post.title}}</h2>
      <span :class="props.post.type">{{postType(props.post.type)}}</span>
    </div>
    <p>{{props.post.message}}</p>
    <PostEdit 
      v-if="state.isEdit" 
      :post="props.post" 
      @close="state.isEdit = false"
    />
    <ConfirmationModal :show="state.isDelete">
      <template v-slot:title>
        <span>Delete</span>
      </template>
      <template v-slot:content>
        <span>Are you sure you want to delete this post?</span>
      </template>
      <template v-slot:footer>
        <div class="flex space-x-4">
          <button @click="state.isDelete = false" class="w-32 dark:text-white border dark:border-white border-slate-500">No</button>
          <button @click="deletePost" class="w-32 text-white bg-red-500 py-2">Yes</button>
        </div>
      </template>
    </ConfirmationModal>
  </div>
</template>

<script setup>
import moment from 'moment';
import { computed, reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

import PostEdit from '@/Components/Posts/PostEdit.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const page = usePage()
const user = computed(() => page.props.auth.user)

const props = defineProps({ 
    post: Object
})

const state = reactive({
  isEdit: false,
  isDelete: false
});

const postedDate = (timestamp) => {
  return moment(timestamp).format('MMMM D, YYYY');
}

const postType =  (type) => {
  return type.charAt(0).toUpperCase() + type.slice(1)
}

const deletePost = () => {
  router.delete('/posts/delete/' + props.post.id)
  state.isDelete = false
}

</script>

<style scoped>

.news{
  @apply dark:text-yellow-400 text-yellow-600
}

.update{
 @apply dark:text-blue-400 text-blue-600
}

.task{
  @apply dark:text-green-400 text-green-600
}

</style>
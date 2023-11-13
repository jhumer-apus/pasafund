<template>
  <div>
    <Pagination class="mt-6" :links="props.posts.links" /><br>
    <div v-for="(post, i) in posts.data" :key="i">
      <PostCard :post="post"/><br>
    </div><br>
    <Pagination class="mt-6" :links="props.posts.links" />
  </div>
</template>

<script setup>
import PostCard from '@/Components/Posts/PostCard.vue';
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({ 
    posts: Object
})

</script>

<style>

</style>
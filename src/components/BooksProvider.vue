<template>
  <slot :books="books" :setTags="setTags"></slot>
</template>

<script setup>
import { ref, computed } from "vue/dist/vue.esm-bundler.js";
const props = defineProps({
  initialBooks: {
    type: Array,
    required: true,
  },
});

const tag1 = ref();
const tag2 = ref();
const books = computed(() => {
  return props.initialBooks.filter((book) => {
    if (tag1.value) {
      if (book.tags1.findIndex((tag) => tag.id == tag1.value) === -1) {
        return false;
      }
    }
    if (tag2.value) {
      if (book.tags2.findIndex((tag) => tag.id == tag2.value) === -1) {
        return false;
      }
    }
    return true;
  });
});

const setTags = async (tags) => {
  console.log("setTags", tags);
  tag1.value = tags.tag1;
  tag2.value = tags.tag2;
};
</script>

<style lang="scss" scoped></style>

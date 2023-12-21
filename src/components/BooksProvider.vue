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

const tags1 = ref([]);
const tags2 = ref([]);
const books = computed(() => {
  return props.initialBooks.filter((book) => {
    if (tags1.value.length > 0) {
      if (book.tags1.findIndex((tag) => tags1.value.includes(tag.id)) === -1) {
        return false;
      }
    }
    if (tags2.value.length > 0) {
      if (book.tags2.findIndex((tag) => tags2.value.includes(tag.id)) === -1) {
        return false;
      }
    }
    return true;
  });
});

const setTags = async (tags) => {
  tags1.value = tags.tags1;
  tags2.value = tags.tags2;
};
</script>

<style lang="scss" scoped></style>

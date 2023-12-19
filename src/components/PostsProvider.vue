<template>
  <slot
    :posts="posts"
    :totalPageCount="totalPageCount"
    :currentPageNumber="currentPageNumber"
    :setFilter="setFilter"
    :setPage="setPage"
  ></slot>
</template>

<script setup>
import { nextTick, ref } from "vue/dist/vue.esm-bundler.js";
const props = defineProps({
  url: {
    type: String,
    required: true,
  },
  initialPosts: {
    type: Array,
    required: true,
  },
  initialTotalPageCount: {
    type: Number,
    required: true,
  },
  scrollTargetId: {
    type: String,
    default: null,
  },
});

const posts = ref([...props.initialPosts]);
const totalPageCount = ref(props.initialTotalPageCount);
const currentPageNumber = ref(1);
const filters = ref({});

const fetchPosts = async () => {
  try {
    const url = new URL(props.url);
    url.searchParams.append("action", "filter_posts");
    for (const [key, value] of Object.entries(filters.value)) {
      url.searchParams.append(key, value);
    }
    url.searchParams.append("page", currentPageNumber.value);
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Network response was not OK");
    }
    const json = await response.json();
    posts.value = json.data.posts;
    totalPageCount.value = json.data.totalPageCount;
  } catch (error) {
    console.error("There has been a problem with your fetch operation:", error);
  }
};

const setFilter = async (key, value) => {
  filters.value[key] = value;
  currentPageNumber.value = 1;
  await fetchPosts();
};

const setPage = async (newPageNumber) => {
  console.log("setPage");
  currentPageNumber.value = newPageNumber;
  await fetchPosts();
  if (!props.scrollTargetId) {
    return;
  }
  nextTick(() => {
    const element = document.getElementById(props.scrollTargetId);
    if (!element) {
      return;
    }
    window.scrollTo(0, element.offsetTop - 32);
  });
};
</script>

<style lang="scss" scoped></style>

<template>
  <div class="hfh-theme-book-grid">
    <ul>
      <li v-for="post in pages" :key="post.id">
        <hfh-teaser
          :link="post.url"
          :image-src="post.imageSrc"
          :image-alt="post.imageAlt"
          :pretitle="post.pretitle"
          :title="post.title"
        >
          <!-- {{ post.excerpt }} -->
        </hfh-teaser>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { HfhTeaser } from "@hfh-dlc/hfh-styleguide";
const props = defineProps({
  pages: {
    type: Array,
    required: true,
  },
});
</script>

<style lang="scss" scoped>
.hfh-theme-book-grid {
  @import "../styles/mixins";

  @include hfh-theme-content-container-width;

  ul {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(288px, 1fr));
    column-gap: 1rem;
    row-gap: 1rem;
    margin-top: 3.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
  }
}
</style>

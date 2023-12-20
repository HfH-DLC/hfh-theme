<template>
  <div class="hfh-theme-book-grid">
    <ul>
      <li v-for="book in books" :key="book.id">
        <hfh-teaser
          :link="book.url"
          :image-src="book.imageSrc"
          :image-alt="book.imageAlt"
          :pretitle="book.pretitle"
          :title="book.title"
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
  books: {
    type: Array,
    required: true,
  },
});
</script>

<style lang="scss" scoped>
.hfh-theme-book-grid {
  @import "../styles/mixins";

  @include hfh-theme-content-container-width;

  padding-inline: 1rem;

  ul {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(225px, 280px));
    column-gap: 1rem;
    row-gap: 1rem;
    margin-top: 3.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
  }
}
</style>

<template>
  <HfhHeader
    :primaryItems="menuState.primaryItems"
    :secondaryItems="menuState.secondaryItems"
    :tertiaryItems="menuState.tertiaryItems"
    @updateItems="onUpdateItems"
    @search="onSearch"
  >
    <template #logo-desktop>
      <a class="hfh-theme-logo-desktop" :href="homeUrl"
        ><HfhLogo></HfhLogo><slot name="site-name"></slot
      ></a>
    </template>
    <template #logo-mobile>
      <a class="hfh-theme-logo-mobile" :href="homeUrl"
        ><HfhLogo></HfhLogo><slot name="site-name"></slot
      ></a>
    </template>
  </HfhHeader>
</template>

<script setup>
import { ref } from "vue";
import { HfhHeader, HfhLogo } from "@hfh-dlc/hfh-styleguide";
const props = defineProps({
  primaryItems: {
    type: Array,
    default: () => [],
  },
  secondaryItems: {
    type: Array,
    default: () => [],
  },
  tertiaryItems: {
    type: Array,
    default: () => [],
  },
  languages: {
    type: Array,
    default: () => [],
  },
  search: {
    type: Boolean,
    default: false,
  },
  currentItem: {
    type: String,
    default: null,
  },
  homeUrl: {
    type: String,
    required: true,
  },
});

const menuState = ref({
  primaryItems: props.primaryItems,
  secondaryItems: props.secondaryItems,
  tertiaryItems: props.tertiaryItems,
});

const onUpdateItems = (items) => {
  menuState.value.primaryItems = items.primaryItems;
  menuState.value.secondaryItems = items.secondaryItems;
  menuState.value.tertiaryItems = items.tertiaryItems;
};
</script>

<style lang="scss" scoped></style>

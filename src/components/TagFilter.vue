<template>
  <div>
    <div class="hfh-label">Filtern nach</div>
    <div class="taglist">
      <HfhCheckbox
        :id="`hfh-theme-catalog-tags`"
        :legend="tag1Name"
        :options="tag1Options"
        v-model="activeTags.tags1"
        :orientation="vertical"
      ></HfhCheckbox>
    </div>
    <div class="taglist">
      <HfhCheckbox
        :id="`hfh-theme-catalog-tags`"
        :legend="tag2Name"
        :options="tag2Options"
        v-model="activeTags.tags2"
        :orientation="vertical"
      ></HfhCheckbox>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { HfhCheckbox } from "@hfh-dlc/hfh-styleguide";

const props = defineProps({
  tag1Name: {
    type: String,
    required: true,
  },
  tags1: {
    type: Array,
    required: true,
  },
  tag2Name: {
    type: String,
    required: true,
  },
  tags2: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(["tagsChanged"]);
const activeTags = ref({
  tags1: [],
  tags2: [],
});

const tag1Options = computed(() =>
  props.tags1.map((tag) => ({
    label: tag.tag,
    value: tag.id,
    name: tag.id,
  }))
);

const tag2Options = computed(() =>
  props.tags2.map((tag) => ({
    label: tag.tag,
    value: tag.id,
    name: tag.id,
  }))
);

watch(activeTags, () => emit("tagsChanged", activeTags.value), { deep: true });
</script>

<style lang="scss" scoped>
.taglist {
  margin-top: 1rem;
  & + .taglist {
    margin-top: 0.5rem;
  }

  .hfh-label {
    margin-bottom: 0;
  }
}
.tag {
  &:hover {
    color: var(--c-thunderbird-red);
  }

  &.tag--active {
    font-weight: bold;
  }
}
</style>

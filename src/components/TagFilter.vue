<template>
  <div>
    <div class="hfh-label">Filtern nach</div>
    <div class="taglist">
      <h2 class="hfh-label">{{ tag1Name }}</h2>
      <ul>
        <li v-for="tag in tags1">
          <button
            class="tag"
            :class="{ 'tag--active': activeTags.tag1 == tag.id }"
            @click="() => toggleTag1(tag.id)"
          >
            {{ tag.tag }}
          </button>
        </li>
      </ul>
    </div>
    <div class="taglist">
      <h2 class="hfh-label">{{ tag2Name }}</h2>
      <ul>
        <li v-for="tag in tags2">
          <button
            class="tag"
            :class="{ 'tag--active': activeTags.tag2 == tag.id }"
            @click="() => toggleTag2(tag.id)"
          >
            {{ tag.tag }}
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

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
  tag1: null,
  tag2: null,
});

const toggleTag1 = (id) => {
  activeTags.value.tag1 = activeTags.value.tag1 === id ? null : id;
  emit("tagsChanged", activeTags.value);
};

const toggleTag2 = (id) => {
  activeTags.value.tag2 = activeTags.value.tag2 === id ? null : id;
  emit("tagsChanged", activeTags.value);
};
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

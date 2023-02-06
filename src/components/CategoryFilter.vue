<template>
  <form class="hfh-category-filter" @submit.prevent>
    <hfh-filter-group @reset="reset">
      <template v-for="(filter, index) in filters" :key="index">
        <hfh-select
          v-bind="filter"
          v-model="values[index]"
          @update:modelValue="onUpdate"
          defaultOption="- Alle -"
        />
      </template>
    </hfh-filter-group>
  </form>
</template>

<script setup>
import { computed, ref } from "vue/dist/vue.esm-bundler.js";
import { HfhSelect, HfhFilterGroup } from "@hfh-dlc/hfh-styleguide";

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(["filterChanged"]);

const values = ref([]);
const reset = () => {
  values.value = [];
  onUpdate();
};

const filters = computed(() => {
  return props.categories.reduce((acc, cur) => {
    const category = {
      id: `hfh-category-filter-${cur.id}`,
      label: cur.name,
      name: cur.name,
      options: getOptions(cur),
    };
    acc.push(category);
    return acc;
  }, []);
});

const getOptions = (category, depth = 0) => {
  const prefix = "&nbsp;".repeat(depth);
  let options = [];
  if (category.children) {
    options = category.children.reduce((acc, cur) => {
      acc.push({
        label: prefix + cur.name,
        value: cur.id.toString(),
      });
      acc.push(...getOptions(cur, depth + 1));
      return acc;
    }, []);
  }
  return options;
};

const onUpdate = () => {
  emit(
    "filterChanged",
    "category_ids",
    values.value.filter((n) => n)
  );
};
</script>

<style lang="scss" scoped>
</style>
import { createApp, onMounted, inject } from "vue/dist/vue.esm-bundler.js";
import {
  HfhContact,
  HfhFooter,
  HfhLink,
  HfhPagination,
  HfhSearchBar,
  HfhSearchResult,
  HfhSocialBlock,
  HfhSlider,
  HfhTeaser,
  HfhArrowIcon,
} from "@hfh-dlc/hfh-styleguide";
import "@hfh-dlc/hfh-styleguide/dist/style.css";
import "./styles/style.scss";

import PostsProvider from "./components/PostsProvider.vue";
import CategoryFilter from "./components/CategoryFilter.vue";
import PageGrid from "./components/PageGrid.vue";
import HeaderWrapper from "./components/HeaderWrapper.vue";

const useAppMounted = () => {
  const onAppMounted = inject("onAppMounted");
  onMounted(() => {
    if (onAppMounted) {
      onAppMounted();
    }
  });
};

function mountVueApp(app, mountPoint) {
  if (!document.querySelector(mountPoint)) {
    return;
  }

  return new Promise((resolve, reject) => {
    try {
      app.provide("onAppMounted", () => {
        resolve();
      });
      app.mount(mountPoint);
    } catch (error) {
      console.error(`Error mounting app at ${mountPoint}:`, error);
      reject(error);
    }
  });
}

function mountApps() {
  let promises = [];

  const header = createApp({
    components: {
      HeaderWrapper,
    },
    setup() {
      useAppMounted();
    },
  });
  header.component("header-wrapper", HeaderWrapper);
  promises.push(mountVueApp(header, "#hfh-theme-header"));

  const homePosts = createApp({
    components: {
      HfhSlider,
      CategoryFilter,
      PostsProvider,
      PageGrid,
      HfhPagination,
      HfhTeaser,
    },
    setup() {
      useAppMounted();
    },
  });
  homePosts.component("hfh-slider", HfhSlider);
  homePosts.component("category-filter", CategoryFilter);
  homePosts.component("posts-provider", PostsProvider);
  homePosts.component("page-grid", PageGrid);
  homePosts.component("hfh-teaser", HfhTeaser);
  homePosts.component("hfh-pagination", HfhPagination);
  promises.push(mountVueApp(homePosts, "#hfh-theme-home-posts"));

  const archivePosts = createApp({
    components: {
      HfhSlider,
      CategoryFilter,
      PostsProvider,
      PageGrid,
      HfhPagination,
      HfhTeaser,
    },
    setup() {
      useAppMounted();
    },
  });
  archivePosts.component("hfh-slider", HfhSlider);
  archivePosts.component("category-filter", CategoryFilter);
  archivePosts.component("posts-provider", PostsProvider);
  archivePosts.component("page-grid", PageGrid);
  archivePosts.component("hfh-teaser", HfhTeaser);
  archivePosts.component("hfh-pagination", HfhPagination);
  promises.push(mountVueApp(archivePosts, "#hfh-theme-archive-posts"));

  const single = createApp({
    components: {
      HfhArrowIcon,
      HfhLink,
      HfhTeaser,
    },
    setup() {
      useAppMounted();
    },
  });
  single.component("hfh-link", HfhLink);
  single.component("hfh-arrow-icon", HfhArrowIcon);
  single.component("hfh-teaser", HfhTeaser);
  promises.push(mountVueApp(single, "#hfh-theme-single"));

  const contact = createApp({
    components: {
      HfhContact,
    },
    setup() {
      useAppMounted();
    },
  });
  contact.component("hfh-contact", HfhContact);
  promises.push(mountVueApp(contact, "#hfh-theme-contact"));

  const footer = createApp({
    components: {
      HfhFooter,
      HfhSocialBlock,
    },
    setup() {
      useAppMounted();
    },
  });
  footer.component("hfh-footer", HfhFooter);
  footer.component("hfh-social-block", HfhSocialBlock);
  promises.push(mountVueApp(footer, "#hfh-theme-footer"));

  const searchForm = createApp({
    components: {
      HfhSearchBar,
    },
    setup() {
      useAppMounted();
    },
  });
  searchForm.component("hfh-search-bar", HfhSearchBar);
  searchForm.mount("#hfh-theme-search-form");

  const searchResults = createApp({
    components: {
      HfhPagination,
      HfhSearchResult,
    },
    setup() {
      useAppMounted();
    },
  });
  searchResults.component("hfh-pagination", HfhPagination);
  searchResults.component("hfh-search-result", HfhSearchResult);
  promises.push(mountVueApp(searchResults, "#hfh-theme-search-results"));

  promises = promises.filter((promise) => promise !== undefined);

  // Wait for all Vue instances to be mounted
  Promise.all(promises).then(() => {
    document.querySelector(".js-content").classList.remove("js-content");
  });
}

document.addEventListener("DOMContentLoaded", mountApps);

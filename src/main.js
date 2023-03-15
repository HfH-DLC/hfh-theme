import { createApp, onMounted } from "vue/dist/vue.esm-bundler.js";
import {
  HfhContact,
  HfhFooter,
  HfhHeader,
  HfhLogo,
  HfhPagination,
  HfhSearchBar,
  HfhSearchResult,
  HfhSocialBlock,
  HfhSlider,
  HfhTeaser,
} from "@hfh-dlc/hfh-styleguide";
import "@hfh-dlc/hfh-styleguide/dist/style.css";
import "./styles/style.scss";

import PostsProvider from "./components/PostsProvider.vue";
import CategoryFilter from "./components/CategoryFilter.vue";
import PageGrid from "./components/PageGrid.vue";

const app = createApp({
  components: {
    HfhContact,
    HfhFooter,
    HfhHeader,
    HfhLogo,
    HfhPagination,
    HfhSearchBar,
    HfhSearchResult,
    HfhSocialBlock,
    HfhTeaser,

    CategoryFilter,
    PostsProvider,
    PageGrid,
  },
  setup() {
    const onSearch = (searchText) => {
      const searchUrl = new URL("/", wp_config.homeUrl);
      searchUrl.searchParams.append("s", searchText);
      window.location.href = searchUrl.href;
    };

    onMounted(() => {
      document.querySelector(".js-content").classList.remove("js-content");
    });

    return { onSearch };
  },
});

app
  .component("hfh-contact", HfhContact)
  .component("hfh-footer", HfhFooter)
  .component("hfh-header", HfhHeader)
  .component("hfh-logo", HfhLogo)
  .component("hfh-pagination", HfhPagination)
  .component("hfh-teaser", HfhTeaser)
  .component("hfh-search-bar", HfhSearchBar)
  .component("hfh-search-result", HfhSearchResult)
  .component("hfh-slider", HfhSlider)
  .component("hfh-social-block", HfhSocialBlock)
  .component("posts-provider", PostsProvider)
  .component("page-grid", PageGrid);

app.mount("#page");

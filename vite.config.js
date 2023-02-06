import { resolve } from "path";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import autoprefixer from "autoprefixer";

export default defineConfig(({ mode }) => {
  return {
    plugins: [vue()],
    define: {
      "process.env.NODE_ENV": JSON.stringify(mode),
    },
    css: {
      postcss: {
        plugins: [autoprefixer],
      },
    },
    build: {
      lib: {
        // Could also be a dictionary or array of multiple entry points
        entry: [resolve(__dirname, "src/main.js")],
        name: "HfhThemeAssets",
        // the proper extensions will be added
        fileName: "hfh-theme-assets",
      },
      rollupOptions: {},
    },
  };
});

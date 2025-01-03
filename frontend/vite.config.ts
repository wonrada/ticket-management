import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vite.dev/config/
export default defineConfig({
  plugins: [vue()],
  json: {
    // enable/disable the handling of .json imports
    stringify: true,  // optional, if you need to handle JSON differently
  },
})

module.exports = {
  parserOptions: {
    parser: "babel-eslint", // Or another parser like '@babel/eslint-parser' if needed
  },
  extends: [
    "plugin:vue/vue3-recommended", // For Vue 3
    "eslint:recommended",
  ],
  plugins: ["vue"],
  rules: {
    "vue/no-multiple-template-root": "off", // Disable this rule for Vue 3
  },
  env: {
    node: true,
    browser: true,
  },
};

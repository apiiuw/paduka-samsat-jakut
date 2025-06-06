/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./../node_modules/flowbite",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    "flowbite/plugin",
  ],
}


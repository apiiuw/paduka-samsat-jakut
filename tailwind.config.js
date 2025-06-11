/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./../node_modules/flowbite",
  ],
  theme: {
    extend: {
      colors: {
        blueJR: "#006AB2",
        blueJRdark: "#00548C",
      },
      fontFamily: {
        'jakartaSans': ["'Plus Jakarta Sans'", 'sans-serif'],
      },
    },
  },
  plugins: [
    require("flowbite/plugin"),
  ],
}

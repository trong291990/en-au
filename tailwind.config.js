/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/app.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    // "./resources/**/**/*.vue",
    // "./resources/**/**/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'playlist-bg': "url('/img/bg.jpg')",
      }
    },
    screens: {
      'iphone15pro': {'raw': '(max-width: 428px)'},
    },
  },
  plugins: [],
}


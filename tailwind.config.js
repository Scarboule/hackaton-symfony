/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      screens: {
        'xs' :{'max': '480px'},
        'ss' :{'max': '720px'},
        'tab':{'max': '1024px'},
      },
    },
  },
  plugins: [],
}

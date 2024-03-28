/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.html.twig"],
  theme: {
    extend: {
      gridTemplateColumns: {
        '2': 'repeat(2, 1fr)',
        'custom': 'grid-repeat-2',
      }
    },
  },
  plugins: [],
}


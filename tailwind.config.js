/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.html.twig"],
  theme: {
    extend: {
      gridTemplateColumns: {
        'repeat-2': 'repeat(2, 1fr)',
      },
    },
  },
  plugins: [],
}


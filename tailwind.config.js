/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{php,html,phtml,js}"],
  theme: {
    extend: {},
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '992px',
      'xl': '1200px',
      '2xl': '1536px',
    }
  },
  plugins: [],
}


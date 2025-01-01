/** @type {import('tailwindcss').Config} */
import colors from 'tailwindcss/colors';

export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {

    fontFamily: {
      sans: ['Roboto', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      colors: {
        primaryColor: "#ff7a21",
        secondryColor: "#ffffff",
        thirdColor: "#343434",
        pink: colors.fuchsia,
        borderColor: "#d1d5db"
      },
      borderRadius: {
        'buttonRadius': '10px',
        'inputRadius':'12px'
      }
},
  },
  plugins: [],
}


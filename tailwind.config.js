/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Primary color scheme - Elephant
        elephant: {
          50: '#f1f7fa',
          100: '#dcebf1',
          200: '#bdd8e4',
          300: '#8fbcd1',
          400: '#5a98b6',
          500: '#3e7c9c',
          600: '#366684',
          700: '#32556c',
          800: '#2f475b',
          900: '#253543',
          950: '#182734',
        },
        // Success color scheme - Forest Green
        'forest-green': {
          50: '#f1fcf2',
          100: '#ddfbe3',
          200: '#bdf5c9',
          300: '#8aeba0',
          400: '#50d86f',
          500: '#29be4b',
          600: '#1b9938',
          700: '#197c30',
          800: '#19622b',
          900: '#175026',
          950: '#072c11',
        },
        // Danger color scheme - Old Brick
        'old-brick': {
          50: '#fdf3f3',
          100: '#fde3e3',
          200: '#fbcdcd',
          300: '#f8a9a9',
          400: '#f17878',
          500: '#e64d4d',
          600: '#d32f2f',
          700: '#b12424',
          800: '#992323',
          900: '#7a2222',
          950: '#420d0d',
        },
        // Semantic color aliases
        primary: '#253543',
        success: '#1b9938',
        danger: '#992323',
      },
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('tailwindcss-animate'),
  ],
}
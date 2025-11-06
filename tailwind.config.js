import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',              // zaten var
    './resources/views/components/**/*.blade.php',   // özellikle ekle
    './resources/js/**/*.js',
  ],
  safelist: [
    'md:grid','md:grid-cols-[18rem_1fr]','md:static','md:translate-x-0','md:hidden',
    '-translate-x-full','fixed','inset-y-0','left-0'
  ],
  theme: {
    extend: {
      fontFamily: { sans: ['Figtree', ...defaultTheme.fontFamily.sans] }
    },
  },
  plugins: [forms],
}


/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./application/views/**/*.php",
    "./resources/**/*.html",
    "./public/**/*.html"
  ],
  theme: {
    extend: {
      colors: {
        // === CLIPMINER BRAND TOKENS ===
        brand: {
          primary: "#6366F1",   // Indigo
          bg: "#0F1220",        // Deep Navy
          surface: "#1A1F36"    // Dark Slate
        }
      }
    }
  },
  plugins: []
}


/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend:{
      colors:{
        "dark-green": "#102110",
        "medium-green": "#032617",
        
      },
    },

    fontFamily:{
      // Inter: ["Inter, sans-serif"],
      // DM: ["DM Sans, sans-serif"],
      Montserrat: ["Montserrat, sans-serif"],
    },

    screens:{
      xs: "480px",
      sm:"640px",
      md:"987px",
      lg:"1376px",


    }
  },
  plugins: [],
}
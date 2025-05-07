module.exports = {
  content: [
      "./resources//*.blade.php",
      "./resources//*.js",
      "./resources//*.vue",
      "./resources//*.jsx",
      "./resources//*.tsx",
      "./app//*.php",
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
      extend: {
          colors: {
              primary: {
                  DEFAULT: "#5bc0de",
                  50: "#edf8fc",
                  100: "#d0ebf5",
                  200: "#a1d7eb",
                  300: "#71c3e1",
                  400: "#5bc0de", // Primary color
                  500: "#3aa9d0",
                  600: "#2489b0",
                  700: "#1d6f90",
                  800: "#195a75",
                  900: "#174b61",
              },
          },
          fontFamily: {
              sans: ["Poppins", "sans-serif"],
              script: ["Dancing Script", "cursive"],
              sansSerif: ["Work Sans", "sans-serif"],
          },
          boxShadow: {
              custom: "0 4px 30px rgba(0, 0, 0, 0.1)",
          },
          backdropBlur: {
              custom: "10px",
          },
          borderRadius: {
              large: "1.5rem",
          },
      },
  },
  plugins: [
      require("@tailwindcss/forms")({
          strategy: "class",
      }),
  ],
  corePlugins: {
      container: true,
  },
};
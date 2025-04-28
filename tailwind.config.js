/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["InterVariable", ...defaultTheme.fontFamily.sans],
            },
            writingMode: {
                "vertical-rl": "vertical-rl",
                "vertical-lr": "vertical-lr",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        function ({ addUtilities }) {
            addUtilities({
                ".vertical-rl": {
                    "writing-mode": "vertical-rl",
                },
                ".vertical-lr": {
                    "writing-mode": "vertical-lr",
                },
            });
        },
    ],
};

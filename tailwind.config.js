/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'selector',
    content: ["./resources/views/**/*.{html,js,php}"],
    theme: {

        extend: {
            keyframes: {
                float: {
                    '0%, 100%': {transform: 'translateY(0)'},
                    '50%': {transform: 'translateY(-20px)'},
                },
            },
            animation: {
                float: 'float 4s ease-in-out infinite',
            },
        },

    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [{
            bonbon: {
                "primary": "#a786df",
                "primary-content": "#E6E6FA",
                "secondary": "#d9d4e7",
                "accent": "#FF7F50",
                "neutral": "#2c2b2b",
                "base-100": "#ffebf2",
                "base-content": "#0e172c",
                "info": "#0e172c",
                "success": "#F5FFFA",
                "warning": "#FFFFE0",
                "error": "#E30B5C",
            },
        }, "dim", "nord", "retro"],
        darkTheme: "dim"
    },

}

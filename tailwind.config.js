/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'selector',
    content: [
        "./resources/views/**/*.{blade.php,html,js}",
        "./resources/livewire/**/*.{blade.php,html,js}",
    ],
    plugins: [require("daisyui")],

    daisyui: {
        themes: ["dim", "nord", "retro"],
        darkTheme: "dim"
    },
}

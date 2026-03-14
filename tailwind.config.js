import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // Habilita o modo escuro via classe CSS
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Usando variáveis CSS para facilitar a troca de tema
                background: "var(--color-bg)",
                surface: "var(--color-surface)",
                text: "var(--color-text)",
                textMuted: "var(--color-text-muted)",
                primary: "#E8B84B", // Cor de destaque dourada
                primaryHover: "#d4a338",
            },
        },
    },

    plugins: [],
};

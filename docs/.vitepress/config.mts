import { defineConfig } from "vitepress";

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "Laravel Architect",
    description:
        "A package for creating an alternate Laravel application structure.",
    themeConfig: {
        // https://vitepress.dev/reference/default-theme-config
        nav: [{ text: "Home", link: "/" }],

        sidebar: [
            {
                text: "Getting Started",
                items: [
                    { text: "What is this for?", link: "/what-is-this-for" },
                    { text: "Package Install", link: "/package-install" },
                    { text: "Config", link: "/config" },
                ],
            },
            {
                text: "Command Reference",
                items: [
                    {
                        text: "Artisan Commands",
                        link: "/artisan-commands",
                    },
                    {
                        text: "Additional Commands",
                        link: "/additional-commands",
                    },
                ],
            },
        ],

        socialLinks: [
            { icon: "github", link: "https://github.com/vuejs/vitepress" },
        ],
    },
});

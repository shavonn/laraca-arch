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
                items: [{ text: "Installation", link: "/installation" }],
            },
            {
                text: "Config",
                items: [
                    {
                        text: "Structure",
                        link: "/config-structure",
                    },
                    {
                        text: "Domains",
                        link: "/config-domains",
                    },
                    {
                        text: "Microservices",
                        link: "/config-microservices",
                    },
                ],
            },
            {
                text: "CLI Reference",
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
            {
                icon: "github",
                link: "https://github.com/handsomebrown/laraca-arch",
            },
        ],
    },
});
